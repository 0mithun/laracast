<?php

namespace App\Http\Requests;

use App\Series;
use Illuminate\Foundation\Http\FormRequest;

class CreateSeriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required',
            'description'   =>  'required',
            'image'     =>  'required|image'
        ];
    }

    public function uploadSeriesImage(){
        $image = $this->image;
        $this->fileName =  str_slug($this->title).".".$image->getClientOriginalExtension();

        $image->storePubliclyAs('series', $this->fileName);

        return $this;
    }

    public function storeSeries(){
       
       $series = Series::create([
            'title'         =>  $this->title,
            'slug'         =>   str_slug( $this->title),
            'description'   =>  $this->description,
            'image_url'     =>  'series/'.$this->fileName
        ]);


        session()->flash('success', 'Series Created Successfully!');

        return redirect()->route('series.show', $series->slug);
    }
}
