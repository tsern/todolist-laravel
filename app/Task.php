<?php
namespace Todo_list;
use Illuminate\Database\Eloquent\Model;
class Task extends Model
{
    //
    protected $fillable = ['id', 'name', 'description', 'start_date', 'end_date', 'user_id', 'type_id'];
}