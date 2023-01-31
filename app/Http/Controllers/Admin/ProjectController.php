<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderby('id', 'desc')->paginate(8);
        $direction = 'desc';
        return view('admin.projects.index',compact('projects', 'direction'));
    }

    public function orderby($column, $direction){

        $direction = $direction === 'desc' ? 'asc' : 'desc';
        $projects = Project::orderby($column, $direction)->paginate(8);
        return view('admin.projects.index',compact('projects', 'direction'));

    }
    public function categories_project(){

        $categories = Category::all();
        return view('admin.projects.list_category_project', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('categories','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project_data = $request->all();
        $project_data['slug'] = Project::generateSlug($project_data['name']);

        if(array_key_exists('cover_image', $project_data)){
            //salvo il nome originale
            $project_data['cover_image_original'] = $request->file('cover_image')->getClientOriginalName();
            //salvo il file sul filesystem e il path in project_data image
            $project_data['cover_image'] = Storage::put('uploads', $project_data['cover_image']);
        }



        /*$new_project = new Project();
        $new_project->fill($project_data);
        $new_project->save();*/
        $new_project = Project::create($project_data);

        if(array_key_exists('technologies', $project_data)){
            $new_project->technologies()->attach($project_data['technlogies']);
        }

        return redirect()->route('admin.projects.show', $new_project)->with('message','Progetto inserito correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        $technologies= Technology::all();
        return view('admin.projects.edit', compact('project', 'categories','technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project_data = $request->all();
        if($project_data['name'] != $project->name){
            $project_data['slug'] = Project::generateSlug($project_data['name']);
        }else{
            $project_data['slug'] = $project->slug;
        }

        $project->update($project_data);

        if(array_key_exists('technologies', $project_data)){
            $project->technologies()->sync($project_data['technologies']);
        }else{
            $project->technologies()->detach();
        }


        return redirect()->route('admin.projects.show', $project)->with('message','Progetto aggioraneto correttamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('deleted','Progetto eliminato correttamente');

    }
}
