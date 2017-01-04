@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New City
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New City Form -->
                    {!! Form::model($cliente, ['action' => 'CityController@store', 'class' => 'form-horizontal']) !!}

                        <!-- City Name -->
                        <div class="form-group">
                            {!! Form::label('nome', 'Nome', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">
                                <div class="input-group">
                                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-fw fa-italic "></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- City District -->
                        <div class="form-group">
                            {!! Form::label('district', 'District', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">
                                <div class="input-group">
                                    {!! Form::text('district', null, ['class' => 'form-control']) !!}
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-fw fa-location-arrow"></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- City Population -->
                        <div class="form-group">
                            {!! Form::label('population', 'Population', ['class' => 'col-sm-3 control-label']) !!}

                            <div class="col-sm-6">
                                <div class="input-group">
                                    {!! Form::number('population', null, ['class' => 'form-control']) !!}
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-fw fa-users "></i></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- City's Country -->
                        <div class="form-group">
                            <label for="country" class="col-sm-3 control-label">Country</label>

                            <div class="col-sm-6">
                                <p class="form-control-static">{{ $country['name'] }}</p>
                                <input name="country" type="hidden" value="{{ $country['id'] }}">
                            </div>
                        </div>

                        <!-- Add City Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add City
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!--</form>-->
                </div>
            </div>

            <!-- Current City -->
            @if (count($cities) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Cities
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped city-table">
                            <thead>
                                <th>City</th>
                                <th>District</th>
                                <th>Population</th>
                                <th>Country</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($cities as $city)
                                    <tr>
                                        <td class="table-text"><div>{{ $city->name }}</div></td>
                                        <td class="table-text"><div>{{ $city->district }}</div></td>
                                        <td class="table-text"><div>{{ $city->population }}</div></td>
                                        <td class="table-text"><div>{{ $countries[$city->country_id] }}</div></td>

                                        <!-- City Delete Button -->
                                        <td>
                                            <a href="{{ action('CityController@edit', $city)}}" class="btn btn-success">
                                               <i class="fa fa-pencil"></i> 
                                            </a>
                                        </td>
                                        <td>
                                            {{ Form::open(['method' => 'DELETE', 'action' => ['CityController@destroy', $city->id]]) }}
                                                {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) }}
                                            {{ Form::close() }}
                                        </td>        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection