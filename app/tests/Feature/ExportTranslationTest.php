<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Http\Controllers\TranslationController;
use App\Models\Language;
use Illuminate\Http\Response;
use Tests\TestCase;
use ZipArchive;

class ExportTranslationTest extends TestCase
{
    public function testInvalidFormat()
    {
        $bearer_token = $this->createReadWriteAccessToken();
        $response = $this
            ->withToken($bearer_token)
            ->get(route('translation.export', ['format' => 'xml']));
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertEquals(TranslationController::INVALID_FORMAT_ERROR, $response->json());
    }

    public function testExportYmlTranslation()
    {
        $bearer_token = $this->createReadWriteAccessToken();
        $response = $this
            ->withToken($bearer_token)
            ->get(route('translation.export', ['format' => 'yml']));
        $response->assertStatus(Response::HTTP_OK);

        $file_path = $response->getFile()->getPathname();
        $zip = new ZipArchive;
        $zip_open_result = $zip->open($file_path);
        if ($zip_open_result === true) {
            $content = $zip->getFromName('translations.yml');
            $this->assertNotEmpty($content);
            $zip->close();
        }
    }

    /**
     * Here we will test the filenames of the zip file if it matches with the language-iso.json format
     */
    public function testExportZipTranslation()
    {
        $bearer_token = $this->createReadWriteAccessToken();
        $response = $this
            ->withToken($bearer_token)
            ->get(route('translation.export', ['format' => 'json']));
        $response->assertStatus(Response::HTTP_OK);

        $file_path = $response->getFile()->getPathname();
        $zip = new ZipArchive;
        $res = $zip->open($file_path);
        if ($res === TRUE) {
            Language::all()->each( function ($language) use ($zip) {
                $json_language_filename = $this->getOutputFileName($language);
                $content = $zip->getFromName($json_language_filename);
                $this->assertNotEmpty($content);
            });
            $zip->close();
        }
    }

    private function getOutputFileName(Language $language): string
    {
        return $language->name . '-' . $language->iso_code . '.json';
    }
}
