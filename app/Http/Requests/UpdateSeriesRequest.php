<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateSeriesRequest extends FormRequest
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
            'image'         =>  'image'
        ];
    }
    public function uploadSeriesImage(){
        $image = $this->image;
        $this->fileName =  str_slug($this->title).".".$image->getClientOriginalExtension();
        $image->storePubliclyAs('public/series', $this->fileName);
        return $this;
    }
}