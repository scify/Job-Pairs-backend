@extends('layouts.app')
@section('content')

            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>FILTERS</h4>
                    </div>
                </div><!--.panel-heading-->
                <div class="panel-body filtersContainer noInputStyles">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-2 filterName">Specialty</div><!--.col-md-3-->
                                <div class="col-md-6">
                                    <select data-placeholder="Choose specialty" name="specialty" id="specialtiesSelect" class="chosen-select">
                                        <option value="">No specialty selected<option>
                                        @foreach($specialties as $specialty)
                                            <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                                        @endforeach
                                    </select>
                                </div><!--.col-md-6-->
                            </div>
                            <div class="row">
                                <div class="col-md-2 filterName">Name</div><!--.col-md-3-->
                                <div class="col-md-6">
                                    <div class="inputer">
                                        <div class="input-wrapper">
                                            <input name="mentorName" class="form-control" placeholder="Mentor name" type="text" id="mentorName">
                                        </div>
                                    </div>
                                </div><!--.col-md-6-->
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">

                            </div>
                            <div class="row">

                            </div>
                        </div>
                    </div>


                    <div class="form-buttons">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button id="searchBtn" class="searchBtn btn btn-primary btn-ripple margin-right-10">
                                    {{trans('messages.search')}} <i class="fa fa-search" aria-hidden="true"></i>
                                </button>

                                <button id="clearSearchBtn" class="searchBtn btn btn-flat-primary btn-ripple margin-right-10">
                                    {{trans('messages.clear_filters')}}
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        <div class="loading-bar indeterminate margin-top-10 hidden loader"></div>

        <div id="errorMsg" class="alert alert-danger stickyAlert margin-top-20 margin-bottom-20 margin-left-100 hidden" role="alert"></div>

        <div id="usersList">
            @include('mentors.list', ['actionButtonsNum' => 2, 'matchingMode' => false])
        </div>
    @include('mentors.modals')
@endsection


@section('additionalFooter')
    <script>
        $( document ).ready(function() {
            var controller = new window.MentorsListController();
            controller.init();
        });
    </script>
@endsection
