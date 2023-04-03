<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\SkillContent;
use Illuminate\Http\Request;

class SkillController extends FarzadController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skillList = Skill::with('_content_lang')->latest()->get();
        return view('skill.index',compact('skillList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skill.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $language       = $request->get('language');
        $title          = $request->get('title');
        $description    = $request->get('description');
        $content        = $request->get('content');
        $icon           = $request->file('icon');
        $year           = $request->get('year');
        $skillid =       $request->get('skillid',0);

        if($icon != null && $icon != '')
            $icon = $this->ImageUploader($icon);
        if($skillid == 0) {
            $skill = skill::create([
                'visit' => 0
            ]);
            $skillid = $skill->id;
        }

        SkillContent::create([
            'skill_id'      =>  $skillid,
            'language'      =>  $language,
            'icon'          =>  $icon,
            'title'         =>  $title,
            'description'   =>  $description,
            'content'       =>  $content,
            'year'          =>  $year
        ]);

        return redirect()->route('skill.edit',$skillid);
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($skill)
    {

        $skill = Skill::where('id','=',$skill)->with('_content_lang')->first();
        return view('skill.edit',compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $language       = $request->get('language');
        $title          = $request->get('title');
        $description    = $request->get('description');
        $content        = $request->get('content');
        $icon           = $request->file('icon');
        $year           = $request->get('year');

        $skillid        = $skill->id;

        $skillContent = SkillContent::where('skill_id','=',$skillid)->
                                      where('language','=',$language)->first();

        if($skillContent != null)
        {
            if($icon != null && $icon != '') {
                $icon = $this->ImageUploader($icon);
            }else{
                $icon = $skillContent->icon;
            }
            $skillContent->update([
                'language'      =>  $language,
                'icon'          =>  $icon,
                'title'         =>  $title,
                'description'   =>  $description,
                'content'       =>  $content,
                'year'          =>  $year
            ]);
        }else{
            if($icon != null && $icon != '')
                $icon = $this->ImageUploader($icon);
            SkillContent::create([
                'skill_id'      =>  $skillid,
                'language'      =>  $language,
                'icon'          =>  $icon,
                'title'         =>  $title,
                'description'   =>  $description,
                'content'       =>  $content,
                'year'          =>  $year
            ]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
