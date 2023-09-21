<?php

namespace App\Http\Controllers;

use App\Http\Requests\Section\SectionPostRequest;
use App\Repositories\Section\SectionInterface;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

/**
 *
 */
class SectionController extends Controller
{

    /**
     * @var SectionInterface
     */
    private SectionInterface $section;

    /**
     * @param SectionInterface $section
     */
    public function __construct(SectionInterface $section)
    {
        $this->middleware('auth');
        $this->section = $section;
    }


    /**
     * Display a listing of the resource.
     */
    public function index($parentId = null)
    {

        if(!is_null($parentId)) {
            $section = $this->section->findSection($parentId);
            // shows 404 not found page if section is not exists
            if(!$section) {
                abort(404);
            }
        }
        $sections = $this->section->getAll($parentId);
        $breadCrumb = $this->section->breadCrumb($parentId);
        return view('section.index', ['parentId' => $parentId, 'sections' => $sections, 'breadCrumb' => $breadCrumb]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionPostRequest $request)
    {

        $user = auth()->user();


        if(!$user->hasAnyPermission([\App\Enums\ACL\Permission::CREATE_FOLDER->value, \App\Enums\ACL\Permission::CREATE_FILE->value])) {
            return response()->json([
                'success' => false,
                'message' => __('You don\'t have the permission to create folder')
            ]);
        }


        $this->section->createSection($request->all());

        return response()->json([
            'success' => true,
            'message' => __('new folder created')
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $this->section->updateSection($request);

        return response()->json([
            'success' => true,
            'message' => __('folder updated')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
