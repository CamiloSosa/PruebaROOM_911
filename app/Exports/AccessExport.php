<?php

namespace App\Exports;

use App\Models\Room911;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AccessExport implements FromCollection, WithHeadings
{

    protected $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Room911::with('user')->where('user_id', $this->user_id)->get();
    }

    public function headings(): array
    {
        return ["Access ID", "User ID", "Status", 'created at', 'Updated at'];
    }

    /**
    * 
    */
    public function map($access): array
    {
        $status = '';
        if($access->status == env(ROOM_ACCESS_SUCCESSFULY)){
            $status = 'Successfuly';
        }elseif($access->status == env(ROOM_ACCESS_DENY)){
            $status = 'Invalid password/id convination';
        }elseif($access->status == env(ROOM_WITHOUT_PERMISSION_ACCESS)){
            $status = 'User had not permission';
        }

        return [
            $access->id,
            $access->user->firstname,
            $status,
            Date::dateTimeToExcel($access->created_at),
            Date::dateTimeToExcel($access->updated_at),
        ];
    }
}
