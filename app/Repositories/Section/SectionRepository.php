<?php

namespace App\Repositories\Section;

use App\Models\Section;
use App\Repositories\Section\SectionInterface;

class SectionRepository implements SectionInterface
{

    public Section $section;

    public function __construct(Section $section)
    {
        $this->section = $section;
    }

    public function getAll(string $parentId = null)
    {
        if($parentId != null)
            return Section::where('parent_id', $parentId)->get();
        return Section::whereNull('parent_id')->get();
    }

    public function findSection($id)
    {
        return Section::where('id', $id)->first();
    }

    public function deleteSection($id)
    {
        // TODO: Implement delete() method.
    }


    public function createSection(array $data)
    {

        if($data['type'] == \App\Enums\Section\Type::FILE->value){


            $path = $this->uploadFile($data['file']);
            $section = Section::create([ 'name' => $path, 'parent_id' => $data['parent_id'], 'type' => $data['type'], 'path' => $path]);
        }  else {
            $section = Section::create($data);
        }


        if(is_null($data['parent_id'])) {
            $parentBreadcrumb = [['name' => 'Root']];
            $section->bread_crumb = json_encode([ ...$parentBreadcrumb, ['name' => $section->name, 'id' => $section->id]]);
        } else {
            $parentSection = Section::where('id', $data['parent_id'])->first();
            $parentBreadcrumb = json_decode($parentSection->bread_crumb);
            $section->bread_crumb = json_encode([ ...$parentBreadcrumb, ['name' => $section->name, 'id' => $section->id]]);

        }

        $section->save();
    }

    public function breadCrumb(string $parentId = null)
    {
        if(is_null($parentId)){
            return [];
        }

        $section = Section::where('id', $parentId)->first();
        return json_decode($section->bread_crumb);
    }

    private function uploadFile($data)
    {

        $fileName = time().'.'.$data->extension();

        $data->move(public_path('images'), $fileName);

        return $fileName;
    }

    public function updateSection($data)
    {
        $section = Section::where('id', $data->id)->first();

        $section->name = $data->name;

        $section->save();
    }
}
