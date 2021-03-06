@extends('layouts.app')

@section('title', 'Ritten')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('splitflaps')}}">ReizigersInformatie</a></li>
            <li class="breadcrumb-item active" aria-current="page">BoardSetup</li>
        </ol>
    </nav>
   
    <div class="row justify-content-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bord Setup') }}</div>
                <div class="card-body">

                @if(session('success') != "")
                <div>
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
                @endif

                @if(session('error') != "")
                <div>
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                </div>
                
                @endif

                    <form method="POST" id="split-setup" autocomplete="off">
                        {{ csrf_field() }}

                        @if (!empty($preview))
                            <div class="form-group row">
                                <label for="test" class="col-md-4 col-form-label text-md-right">Voorbeeld</label>
                                <div class="col-md-6" id="prev">
                                    <board-preview splitflapdata="{{$preview}}"/>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="board" class="col-md-4 col-form-label text-md-right">Spoor</label>
                            <div class="btn-group btn-group-toggle col-md-6" data-toggle="buttons">
                                <label class="mx-0 btn btn-primary form-check-label">
                                    <input id="board" name="board" value="A" class="form-check-input" type="radio" autocomplete="off" @if(($board ?? $data->board ?? 'A') == 'A') checked="checked" @endif> A
                                </label>
                                <label class="mx-0 btn btn-primary form-check-label">
                                    <input id="board" name="board" value="B" class="form-check-input" type="radio" autocomplete="off" @if(($board ?? $data->board ?? 'A') == 'B') checked="checked" @endif> B
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="icon" class="col-md-4 col-form-label text-md-right">Trein</label>
                            <div class="col-md-6">
                                <select name="icon_index" class="form-control">
                                    <option value="0"  @if(($icon_index ?? $data->icon_index ?? '0') == 0)  selected="selected" @endif>[blank]</option>
                                    <option value="1"  @if(($icon_index ?? $data->icon_index ?? '0') == 1)  selected="selected" @endif>IC</option>
                                    <option value="2"  @if(($icon_index ?? $data->icon_index ?? '0') == 2)  selected="selected" @endif>IR</option>
                                    <option value="3"  @if(($icon_index ?? $data->icon_index ?? '0') == 3)  selected="selected" @endif>L</option>
                                    <option value="4"  @if(($icon_index ?? $data->icon_index ?? '0') == 4)  selected="selected" @endif>P</option>
                                    <option value="5"  @if(($icon_index ?? $data->icon_index ?? '0') == 5)  selected="selected" @endif>EXP</option>
                                    <option value="6"  @if(($icon_index ?? $data->icon_index ?? '0') == 6)  selected="selected" @endif>INT</option>
                                    <option value="7"  @if(($icon_index ?? $data->icon_index ?? '0') == 7)  selected="selected" @endif>T</option>
                                    <option value="8"  @if(($icon_index ?? $data->icon_index ?? '0') == 8)  selected="selected" @endif>STOOM</option>
                                    <option value="9"  @if(($icon_index ?? $data->icon_index ?? '0') == 9)  selected="selected" @endif>DIESEL</option>
                                    <option value="10" @if(($icon_index ?? $data->icon_index ?? '0') == 10) selected="selected" @endif>MOTORWAGEN</option>
                                    <option value="11" @if(($icon_index ?? $data->icon_index ?? '0') == 11) selected="selected" @endif>GROEP</option>
                                    <option value="12" @if(($icon_index ?? $data->icon_index ?? '0') == 12) selected="selected" @endif>SINT</option>
                                    <option value="13" @if(($icon_index ?? $data->icon_index ?? '0') == 13) selected="selected" @endif>EVENT</option>
                                    <option value="14" @if(($icon_index ?? $data->icon_index ?? '0') == 14) selected="selected" @endif>DINING</option>
                                    <option value="15" @if(($icon_index ?? $data->icon_index ?? '0') == 15) selected="selected" @endif>DIENST</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time" class="col-md-4 col-form-label text-md-right">Aankomst</label>
                            <div class="col-md-6">
                                <input  required id="time" name="time" class="form-control" type="datetime-local" value="{{strftime('%Y-%m-%dT%H:%M:%S', strtotime($data->time ?? ''))}}">
                            </div>
                        </div>

                        <br>

                        <div class="form-group row">
                            <label for="align" class="col-md-4 col-form-label text-md-right">Text uitlijnen</label>
                            <div class="btn-group btn-group-toggle col-md-6" data-toggle="buttons">
                                <label id="align" class="mx-0 btn btn-primary form-check-label">
                                    <input name="align" value="left" class="form-check-input" type="radio" autocomplete="off" @if(($align ?? $data->align ?? 'left') == 'left') checked @endif> links
                                </label>
                                <label id="align" class="mx-0 btn btn-primary form-check-label">
                                    <input name="align" value="center" class="form-check-input" type="radio" autocomplete="off" @if(($align ?? $data->align ?? 'left') == 'center') checked @endif> center
                                </label>
                                <label id="align" class="mx-0 btn btn-primary form-check-label">
                                    <input name="align" value="right" class="form-check-input" type="radio" autocomplete="off" @if(($align ?? $data->align ?? 'left') == 'right') checked @endif> rechts
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="textA" class="col-md-4 col-form-label text-md-right">Text Boven</label>
                            <div class="col-md-6">
                                <input id="textA" name="first_text" class="form-control" type="text" maxlength="14" spellcheck="false" autocapitalize="off" value="{{$first_text ?? $data->first_text ?? ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="textB" class="col-md-4 col-form-label text-md-right">Text Onder</label>
                            <div class="col-md-6">
                                <input id="textB" name="second_text" class="form-control" type="text" maxlength="14" spellcheck="false" autocapitalize="off" value="{{$second_text ?? $data->second_text ?? ''}}">
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="mx-3 my-1 btn btn-success" formaction="{{ action('SplitflapController@preview') }}">
                                    Voorbeeld
                                </button>

                                @if ($action = 'edit')
                                    <button type="submit" class="mx-3 my-1 btn btn-primary" onclick="return confirmation('split-setup')" formaction="{{ action('SplitflapController@update', ['id' => ($data->id ?? 0)]) }}">
                                        Opslaan
                                    </button>
                                @else
                                    <button type="submit" class="mx-3 my-1 btn btn-primary" onclick="return confirmation('split-setup')" formaction="{{ action('SplitflapController@store') }}">
                                        Verzenden
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>          
</div>
@endsection
