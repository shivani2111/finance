@extends('layouts.admin')
@section('content')

    <style>
        .tdtitle{
            width: 20%;
            font-weight: 600;
        }
    </style>
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Branch
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-borderless ">
                <tbody>
                    <tr>
                        <td class="tdtitle">Branch Name</td>
                        <td>: {{ $branch[0]->branch_name }}</td>
                    </tr>
                    <tr>
                        <td class="tdtitle">Branch Code</td>
                        <td>: {{ $branch[0]->branch_code }}</td>
                    </tr>
                    <tr>
                        <td class="tdtitle">Branch Address</td>
                        <td>: {{ $branch[0]->branch_address }}</td>
                    </tr>
                    <tr>
                        <td class="tdtitle">Branch Postal Code</td>
                        <td>: {{ $branch[0]->branch_postal_code }}</td>
                    </tr>
                    <tr>
                        <td class="tdtitle">Branch State</td>
                        <td>
                            @foreach($states as $s)
                                @if($s->id == $branch[0]->state_id)
                                    : {{ $s->state }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="tdtitle">Branch City</td>
                        <td>
                            @foreach($cities as $c)
                                @if($c->id == $branch[0]->city_id)
                                    : {{ $c->name }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                        <td class="tdtitle">Branch Status</td>
                        <td>: {{ $branch[0]->status }}</td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection