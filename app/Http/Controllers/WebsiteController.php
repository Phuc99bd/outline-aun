<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
        /**
     * Show the website page that corresponds with the current URI.
     */
    public function uri()
    {
        $pageBuilder = app()->make('phpPageBuilder');
        $pageBuilder->handlePublicRequest();
    }
    
    /**
     * Create a new page.
     *
     * @param array $data
     * @return bool|object|null
     * @throws Exception
     */
    public function create(array $data)
    {
        foreach (['name', 'layout'] as $field) {
            if (! isset($data[$field]) || ! is_string($data[$field])) {
                return false;
            }
        }

        $page = parent::create([
            'name' => $data['name'],
            'layout' => $data['layout'],
        ]);
        if (! ($page instanceof PageContract)) {
            throw new Exception("Page not of type PageContract");
        }
        return $this->replaceTranslations($page, $data);
    }
}
