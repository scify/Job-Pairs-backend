@extends('layouts.app')
@section('content')
    <div class="profilePage">
        <div class="page-header full-content parallax">
            <div class="profile-info">
                <div class="profile-photo">
                    <img src="{{ asset("/assets/img/mentor_default.png") }}" alt="Mentor profile image">
                </div><!--.profile-photo-->
                <div class="profile-text light">
                    {{$mentorViewModel->mentor->first_name}}  {{$mentorViewModel->mentor->last_name}},
                    <span class="caption userRole">{{trans('messages.mentor')}}
                        @if($loggedInUser->userHasAccessToCRUDMentorsAndMentees() || $loggedInUser->userHasAccessToEditMentorsAndMentees())
                            <a class="margin-left-10" href="{{route('showEditMentorForm', $mentorViewModel->mentor->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                        @endif
                    </span>
                    <span class="caption {{$mentorViewModel->mentor->status->status}}">
                        @if($mentorViewModel->mentor->status_id != null)
                            {{$mentorViewModel->mentor->status->description}}
                        @endif
                        @if(!empty($mentorViewModel->avgRating))
                            <div id="profile-rating-display" class="rating-display">
                                @for($i = 0; $i < $mentorViewModel->avgRating; $i++)
                                    <span class="glyphicon glyphicon-star"></span>
                                @endfor
                            </div>
                        @endif
                    </span>
                </div><!--.profile-text-->
            </div><!--.profile-info-->

            <div class="row">
                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}"><i class="ion-home"></i></a></li>
                        <li><a href="{{route('showAllMentors')}}">mentors</a></li>
                        <li><a href="#" class="active">{{$mentorViewModel->mentor->first_name}}  {{$mentorViewModel->mentor->last_name}}</a></li>
                    </ol>
            </div><!--.row-->

            <div class="header-tabs scrollable-tabs sticky">
                <ul class="nav nav-tabs tabs-active-text-white tabs-active-border-yellow">
                    <li class="active"><a data-href="details" data-toggle="tab" class="btn-ripple">{{trans('messages.info')}}</a></li>
                    <li><a data-href="skills" data-toggle="tab" class="btn-ripple">{{trans('messages.specialties')}} & {{trans('messages.skills.capitalF')}}</a></li>
                    <li class="match-tab-label @if($mentorViewModel->mentor->status_id != 1) disabled-tab @endif">
                        <a data-href="matching" @if($mentorViewModel->mentor->status_id != 1) onclick="event.stopPropagation();" @else data-toggle="tab" @endif class="btn-ripple">{{trans('messages.match')}}</a>
                    </li>
                    @if($loggedInUser->isAccountManager() || $loggedInUser->isAdmin())
                        <li><a data-href="current_session" data-toggle="tab" class="btn-ripple">{{trans('messages.current_session')}}</a></li>
                        <li><a data-href="mentorship_sessions" data-toggle="tab" class="btn-ripple">{{trans('messages.mentorship_sessions_history')}}</a></li>
                    @endif
                </ul>
            </div>

        </div><!--.page-header-->

        <div class="user-profile">
            <div class="">
                <div class="tab-content without-border">
                    <div id="details" class="tab-pane active">
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title"><h3>Basic Information</h3></div>
                                </div><!--.panel-heading-->
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="formRow row">
                                            <div class="col-md-3 formElementName">{{trans('messages.year_of_birth')}}</div>
                                            <div class="col-md-9">{{$mentorViewModel->mentor->year_of_birth}}  <span class="margin-left-5"> ({{$mentorViewModel->mentor->age}} {{trans('messages.years_old')}})</span></div>
                                        </div><!--.row-->
                                        <div class="formRow row">
                                            <div class="col-md-3 formElementName">{{trans('messages.email')}}</div>
                                            <div class="col-md-9">{{$mentorViewModel->mentor->email}}</div>
                                        </div><!--.row-->
                                        <div class="formRow row">
                                            <div class="col-md-3 formElementName">{{trans('messages.phone')}}</div>
                                            <div class="col-md-9">{{$mentorViewModel->mentor->phone}}</div>
                                        </div><!--.row-->
                                        <div class="formRow row">
                                            <div class="col-md-3 formElementName">{{trans('messages.cell_phone')}}</div>
                                            <div class="col-md-9">{{$mentorViewModel->mentor->phone}}</div>
                                        </div><!--.row-->
                                        <div class="formRow row">
                                            <div class="col-md-3 formElementName">{{trans('messages.address')}}</div>
                                            <div class="col-md-9">{{$mentorViewModel->mentor->address}}</div>
                                        </div><!--.row-->
                                        @if($mentorViewModel->mentor->residence != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.residence')}}</div>
                                                <div class="col-md-9">{{$mentorViewModel->mentor->residence->name}}
                                                    @if(!empty($mentorViewModel->mentor->residence_name)) ({{ $mentorViewModel->mentor->residence_name }}) @endif
                                                </div>
                                            </div><!--.row-->
                                        @endif
                                        <div class="formRow row">
                                            <div class="col-md-3 formElementName">{{trans('messages.linkedin')}}</div>
                                            @if($mentorViewModel->mentor->linkedin_url != null)
                                                <a target="_blank" href="{{$mentorViewModel->mentor->linkedin_url}}"><div class="col-md-9">{{$mentorViewModel->mentor->linkedin_url}}</div></a>
                                            @endif
                                        </div><!--.row-->
                                        @if($mentorViewModel->mentor->created_at != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.joined.capitalF')}}</div>
                                                <div class="col-md-9">{{$mentorViewModel->mentor->created_at->format('d / m / Y')}}</div>
                                            </div><!--.row-->
                                        @endif
                                        @if($mentorViewModel->mentor->creator != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.created_by')}}</div>
                                                <div class="col-md-9"><a href="{{route('showUserProfile', $mentorViewModel->mentor->creator->id)}}">{{$mentorViewModel->mentor->creator->first_name}} {{$mentorViewModel->mentor->creator->last_name}}</a></div>
                                            </div><!--.row-->
                                        @else
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.created_by')}}</div>
                                                <div class="col-md-9">Public form</div>
                                            </div><!--.row-->
                                        @endif
                                        @if($mentorViewModel->mentor->reference_id != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.heard_about')}}</div>
                                                <div class="col-md-9">{{$mentorViewModel->mentor->reference->name}}
                                                    @if(!empty($mentorViewModel->mentor->reference_text)) ({{ $mentorViewModel->mentor->reference_text }}) @endif
                                                </div>
                                            </div><!--.row-->
                                        @endif
                                        @if($mentorViewModel->mentor->status_id != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.status.capitalF')}}</div>
                                                <div class="col-md-9 {{$mentorViewModel->mentor->status->status}}">{{$mentorViewModel->mentor->status->description}}</div>
                                            </div><!--.row-->
                                        @endif
                                    </div>

                                </div><!--.panel-->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title"><h3>Employment & education</h3></div>
                                </div><!--.panel-heading-->
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        @if($mentorViewModel->mentor->company != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.company')}}</div>
                                                <div class="col-md-9">{{$mentorViewModel->mentor->company->name}}</div>
                                            </div><!--.row-->
                                        @endif
                                        @if($mentorViewModel->mentor->company_sector != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.company_sector')}}</div>
                                                <div class="col-md-9">{{$mentorViewModel->mentor->company_sector}}</div>
                                            </div><!--.row-->
                                        @endif
                                        @if($mentorViewModel->mentor->job_position != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.job_position')}}</div>
                                                <div class="col-md-9">{{$mentorViewModel->mentor->job_position}}</div>
                                            </div><!--.row-->
                                        @endif
                                        @if($mentorViewModel->mentor->job_experience_years != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.job_experience_years')}}</div>
                                                <div class="col-md-9">{{$mentorViewModel->mentor->job_experience_years}}</div>
                                            </div><!--.row-->
                                        @endif
                                        @if($mentorViewModel->mentor->education_level_id != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.education_level')}}</div>
                                                <div class="col-md-9">{{$mentorViewModel->mentor->educationLevel->name}}</div>
                                            </div><!--.row-->
                                        @endif
                                        @if($mentorViewModel->mentor->university_id != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.university')}}</div>
                                                <div class="col-md-9">{{$mentorViewModel->mentor->university->name}}
                                                    @if(!empty($mentorViewModel->mentor->university_name)) ({{ $mentorViewModel->mentor->university_name }}) @endif</div>
                                            </div><!--.row-->
                                        @endif
                                        @if($mentorViewModel->mentor->university_department_name != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.university_department')}}</div>
                                                <div class="col-md-9">{{$mentorViewModel->mentor->university_department_name}}</div>
                                            </div><!--.row-->
                                        @endif
                                        @if(!empty($mentorViewModel->mentor->cv_file_name))
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.cv')}}</div>
                                                <div class="col-md-9">
                                                    <a href="{{ url('/') . '/storage/uploads/cv_files/' . $mentorViewModel->mentor->cv_file_name}}"
                                                       class="btn btn-primary btn-orange btn-ripple cv-btn" target="_blank">
                                                        Download CV
                                                    </a>
                                                </div>
                                            </div><!--.row-->
                                        @endif
                                    </div>
                                </div><!--.panel-->
                            </div>
                        </div>
                        @if($mentorViewModel->mentor->statusHistory != null)
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title"><h3>Mentor status history</h3></div>
                                    </div><!--.panel-heading-->
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="timeline">
                                                @foreach($mentorViewModel->mentor->statusHistory as $historyItem)
                                                    <div class="frame">
                                                        <div class="timeline-badge background-{{$historyItem->status->status}}">
                                                            <i class="fa fa-bell "></i>
                                                        </div><!--.timeline-badge-->
                                                        <span class="timeline-date">{{$historyItem->created_at->format('d / m / Y')}}</span>
                                                        <div class="timeline-bubble">
                                                            <h4 class="{{$historyItem->status->status}}">{{$historyItem->status->description}}</h4>
                                                            @if(!empty($historyItem->comment))
                                                                <p>Comment: {{$historyItem->comment}}</p>
                                                            @endif
                                                            @if($historyItem->follow_up_date != null)
                                                                <p>Follow up date: {{ \Carbon\Carbon::parse($historyItem->follow_up_date)->format('d / m / Y')}}</p>
                                                            @endif
                                                        </div><!--.timeline-bubble-->
                                                    </div><!--.frame-->
                                                @endforeach
                                            </div><!--.timeline-->
                                        </div>
                                    </div><!--.panel-->
                                </div>
                            </div>
                        @endif
                    </div>
                    <div id="skills" class="tab-pane">
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title"><h3>{{trans('messages.skills.capitalF')}}</h3></div>
                                </div><!--.panel-heading-->
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        @if($mentorViewModel->mentor->skills != null)
                                            <div class="formRow row">
                                                <div class="col-md-9">{{$mentorViewModel->mentor->skills}}</div>
                                            </div><!--.row-->
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title"><h3>{{trans('messages.specialties')}}</h3></div>
                                </div><!--.panel-heading-->
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        @if($mentorViewModel->mentor->specialties != null)
                                            <div class="formRow row">
                                                <div class="col-md-3 formElementName">{{trans('messages.specialties')}}</div>
                                                <div class="col-md-9">
                                                @foreach($mentorViewModel->mentor->specialties as $specialty)
                                                    {{$specialty->name}}
                                                    @if(!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        @if($mentorViewModel->mentor->industries != null)
                                                <div class="formRow row">
                                                    <div class="col-md-3 formElementName">{{trans('messages.industries')}}</div>
                                                    <div class="col-md-9">
                                                @foreach($mentorViewModel->mentor->industries as $industry)
                                                    {{$industry->name}}
                                                    @if(!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                                    </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="matching" class="tab-pane">
                        @include('mentees.filters')
                        @include('mentees.list', ['menteeViewModels' => $availableMenteeViewModels])
                    </div>
                    @if($loggedInUser->isAccountManager() || $loggedInUser->isAdmin())
                        <div id="current_session" class="tab-pane">
                            @if(!empty($currentSessionViewModel))
                                @include('mentorship_session.list', ['mentorshipSessionViewModels' => $currentSessionViewModel])
                            @else
                                <h4 class="noSessionsMessage">No active mentorship session found.</h4>
                            @endif
                        </div>
                        <div id="mentorship_sessions" class="tab-pane">
                            @if($mentorshipSessionViewModels->count() > 0)
                                @include('mentorship_session.list')
                            @else
                                <h4 class="noSessionsMessage">No mentorship sessions to show.</h4>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if($loggedInUser->userHasAccessToCRUDMentorshipSessions() || $loggedInUser->isMatcher())
        @include('mentorship_session.modals.matching_modal_create', ['mentorViewModel' => $mentorViewModel, 'isCreatingNewSession' => true])
        @include('mentorship_session.modals.matching_modal_edit', ['mentorViewModel' => $mentorViewModel, 'isCreatingNewSession' => false])
        @include('mentorship_session.modals.delete')
    @elseif($loggedInUser->userHasAccessToOnlyEditStatusForMentorshipSessions())
        @include('mentorship_session.modals.matching_modal_edit', ['mentorViewModel' => $mentorViewModel, 'isCreatingNewSession' => false])
    @endif
    @include('mentorship_session.modals.show', ['isCreatingNewSession' => false])
@endsection
@section('additionalFooter')
    <script>
        $( document ).ready(function() {
            var tabsHandler = new window.TabsHandler();
            tabsHandler.init(".profilePage");
            var menteesListController = new window.MenteesListController();
            menteesListController.init("{{Route::currentRouteName()}}");
            var matchingController = new window.MatchingController();
            matchingController.init();
            var mentorshipSessionsListController = new window.MentorshipSessionsListController();
            mentorshipSessionsListController.init("#current_session");
            mentorshipSessionsListController.init("#mentorship_sessions");
            tabsHandler.init("#mentorshipSessionShowModal");
        });
    </script>
@endsection
