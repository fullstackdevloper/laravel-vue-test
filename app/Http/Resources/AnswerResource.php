<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OptionResource;
use App\Http\Resources\QuestionResource;
class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'selectedOption' => new OptionResource($this->option),
            'question' => new QuestionResource($this->question),
            'answerType'=> $this->answerType()
        ];
    }
}
