<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TranslationRequest;
use App\Models\Key;
use App\Models\Language;
use App\Models\Translation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Yaml\Yaml;
use ZipArchive;

class TranslationController extends Controller
{
    private const YML_FILENAME = 'translations.yml';

    public function update(TranslationRequest $request): JsonResponse
    {
        $language_id = $request->language_id;
        $key_id = $request->key_id;

        $language_iso = $request->language_iso;
        $key = $request->key;

        if (! $language_id && ! $key_id && $language_iso && $key) {
            $language_id = Language::where('iso_code', $language_iso)->firstOrFail()->id;
            $key_id = Key::where('name', $key)->firstOrFail()->id;
        }

        $translation = Translation::updateOrCreate(
            ['language_id' => $language_id, 'key_id' => $key_id],
            ['value' => $request->value]
        );

        return response()->json($translation);
    }

    public function export(Request $request): BinaryFileResponse
    {
        $this->validate($request, ['format' => 'required|in:json,yml,yaml']);
        $zip_filename = $this->getArchivedFileName($request->format);

        return response()->download($zip_filename);
    }

    private function getArchivedFileName(string $format): string
    {
        $languages = Language::with(['translations'])->get();

        $zip = new ZipArchive();
        $zip_temp_file = tempnam('/tmp', 'translation_');
        if ($format === 'json') {
            $this->jsonOutputter($zip, $zip_temp_file, $languages);
        } else {
            $this->ymlOutputter($zip, $zip_temp_file, $languages);
        }

        $zip->close();
        $zip_filename = storage_path('zipped_translation_' . uniqid() . '.zip');
        rename($zip_temp_file, $zip_filename);

        return $zip_filename;
    }

    private function ymlOutputter(ZipArchive $zip, string $zip_temp_file, Collection $languages): void
    {
        $collection_output = $languages->mapWithKeys(function (Language $language) {
            $array_output = $this->toKeyNameAndValue($language)->toArray();
            $index = $language->name . '.' . $language->iso_code;

            return [$index => $array_output];
        });

        $array_output = $collection_output->filter(function (array $item) {
            return $item;
        })->toArray();

        $yml_output = Yaml::dump($array_output);
        $temp_file_name = $this->createFileWithContent($yml_output);

        $yml_output_filename = self::YML_FILENAME;
        if ($zip->open($zip_temp_file, ZipArchive::CREATE) === true) {
            if (! $zip->addFile($temp_file_name, $yml_output_filename)) {
                throw new Exception( 'Could not add filename to ZIP: ' . $yml_output_filename);
            }
        } else {
            throw new Exception('Could not open ZIP file. Pls check you permission in /tmp folder');
        }
    }

    /**
     * This will generate the file in the storage folder of Laravel (app/storage/)
     * In case that you cannot generate the file or encountered an error, you missed plugin installation or
     * you need permission on /tmp folder
     */
    private function jsonOutputter(ZipArchive $zip, string $zip_temp_file, Collection $languages): void
    {
        if ($zip->open($zip_temp_file, ZipArchive::CREATE) === true) {
            foreach ($languages as $language) {
                $json_output_filename = $this->getOutputFileName($language);
                $json_output = $this->convertToJsonOutput($language);
                $temp_filename = $this->createFileWithContent($json_output);
                if (! $zip->addFile($temp_filename, $json_output_filename)) {
                    throw new Exception( 'Could not add filename to ZIP: ' . $temp_filename);
                }
            }
        } else {
            throw new Exception('Could not open ZIP file. Pls check you permission in /tmp folder');
        }
    }

    private function getOutputFileName(Language $language): string
    {
        return $language->name . '-' . $language->iso_code . '.json';
    }

    /**
     * @return string filename of the json file created
     */
    private function createFileWithContent(string $content): string
    {
        $temp_filename = tempnam("/tmp/", 'language');
        $fp = fopen($temp_filename, 'w');
        fwrite($fp, $content);
        fclose($fp);

        return $temp_filename;
    }

    private function convertToJsonOutput(Language $language): string
    {
        $collection_output = $this->toKeyNameAndValue($language);

        return $collection_output->toJson(JSON_UNESCAPED_UNICODE);
    }

    private function toKeyNameAndValue(Language $language): Collection
    {
        return $language->translations->mapWithKeys(function (Translation $translation) {
            return [$translation->key->name => $translation->value];
        });
    }
}
