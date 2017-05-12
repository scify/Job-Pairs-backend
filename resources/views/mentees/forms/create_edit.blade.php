@extends('layouts.app')
@section('content')

    <div class="panel" id="createMentee">
        @if(!$publicForm)
            <div class="panel-heading">
                <div class="panel-title">
                    <h4 >{{$formTitle}}</h4>
                </div>

            </div><!--.panel-heading-->
        @endif
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <form class="jobPairsForm noInputStyles" method="POST"
                          action="{{($mentee->id == null ? route('createMentee') : route('editMentee', $mentee->id))}}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if($loggedInUser != null)
                            @if($loggedInUser->userHasAccessToCRUDMentorsAndMentees())
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Mentee status -->
                                        <div class="margin-bottom-5 selecterTitle">{{trans('messages.mentee_status')}}</div>
                                        <select data-placeholder="select" name="status_id" class="chosen-select"
                                                data-original-value="{{ $mentee['status_id'] }}"
                                                data-enable-follow-up-date="4,5">
                                            @foreach($menteeStatuses as $menteeStatus)
                                                <option value="{{$menteeStatus->id}}" {{$mentee['status_id'] == $menteeStatus->id ? 'selected' : ''}}>{{$menteeStatus->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6" id="status-change-comment" style="display: none;">
                                        <!-- Status change comment -->
                                        <div class="{{ $errors->first('status_history_comment')?'has-error has-feedback':'' }}">
                                            <div class="inputer floating-label">
                                                <div class="input-wrapper">
                                                    <input type="text" class="form-control" name="status_history_comment"
                                                           value="{{ old('status_history_comment')}}">
                                                    <label for="status_history_comment">{{trans('messages.status_history_comment')}}</label>
                                                </div>
                                            </div>
                                            <span class="help-block">{{ $errors->first('status_history_comment') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="status-change-follow-up-date" style="display: none;">
                                    <div class="col-md-6">
                                        <!-- Mentor follow up date -->
                                        <div class="{{ $errors->first('follow_up_date')?'has-error has-feedback':'' }}">
                                            <div class="inputer floating-label">
                                                <div class="input-wrapper">
                                                    <input type="text" class="form-control bootstrap-daterangepicker-basic"
                                                           name="follow_up_date" value="{{ old('follow_up_date')}}">
                                                    <label for="follow_up_date">{{trans('messages.follow_up_date')}}</label>
                                                </div>
                                            </div>
                                            <span class="help-block">{{ $errors->first('follow_up_date') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Do not contact again -->
                                        <div class="icheckbox" style="margin-top: 35px;">
                                            <label>
                                                <input type="checkbox" name="do_not_contact">
                                                <label>{{trans('messages.do_not_contact')}}</label>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <!-- First name-->
                                <div class="{{ $errors->first('first_name')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') != '' ? old('first_name') : $mentee['first_name']}}">
                                            <label for="first_name">{{trans('messages.first_name')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('first_name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Last name-->
                                <div class="{{ $errors->first('last_name')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') != '' ? old('last_name') : $mentee['last_name']}}">
                                            <label for="last_name">{{trans('messages.last_name')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('last_name') }}</span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- E-mail -->
                                <div class="{{ $errors->first('email')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="email" class="form-control" name="email"
                                                   value="{{ old('email') != '' ? old('email') : $mentee['email']}}">
                                            <label for="email">{{trans('messages.email')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('email') }}</span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Year of birth -->
                                <div class="{{ $errors->first('year_of_birth')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="number" class="form-control" name="year_of_birth"
                                                   value="{{ old('year_of_birth') != '' ? old('year_of_birth') : $mentee['year_of_birth']}}">
                                            <label for="year_of_birth">{{trans('messages.year_of_birth')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('year_of_birth') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Address -->
                                <div class="{{ $errors->first('address')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="text" class="form-control" name="address"
                                                   value="{{ old('address') != '' ? old('address') : $mentee['address']}}">
                                            <label for="email">{{trans('messages.address')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('address') }}</span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Residence Area -->
                                <div class="margin-bottom-5 selecterTitle">{{trans('messages.residence')}}</div>
                                <select data-placeholder="select" name="residence_id" class="chosen-select">
                                    <option><!-- Empty option allows the placeholder to take effect. --><option>
                                    @foreach($residences as $residence)
                                        <option value="{{$residence->id}}" {{$mentee['residence_id'] == $residence->id ? 'selected' : ''}}>{{$residence->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Phone -->
                                <div class="{{ $errors->first('phone')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="text" class="form-control" name="phone"
                                                   value="{{ old('phone') != '' ? old('phone') : $mentee['phone']}}">
                                            <label for="email">{{trans('messages.phone')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('phone') }}</span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Cell Phone -->
                                <div class="{{ $errors->first('cell_phone')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="text" class="form-control" name="cell_phone"
                                                   value="{{ old('cell_phone') != '' ? old('cell_phone') : $mentee['cell_phone']}}">
                                            <label for="email">{{trans('messages.cell_phone')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('cell_phone') }}</span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Education Level -->
                                <div class="margin-bottom-5 selecterTitle">{{trans('messages.education_level')}}</div>
                                <select data-placeholder="select" name="education_level_id" class="chosen-select">
                                    <option><!-- Empty option allows the placeholder to take effect. --><option>
                                    @foreach($educationLevels as $educationLevel)
                                        <option value="{{$educationLevel->id}}" {{$mentee['education_level_id'] == $educationLevel->id ?
                                                    'selected' : ''}}>{{$educationLevel->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <!-- University -->
                                <div class="margin-bottom-5 selecterTitle">{{trans('messages.university')}}</div>
                                <select data-placeholder="select" name="university_id" class="chosen-select" data-show-name-on-id="12">
                                    <option><!-- Empty option allows the placeholder to take effect. --><option>
                                    @foreach($universities as $university)
                                        <option value="{{$university->id}}" {{$mentee['university_id'] == $university->id ? 'selected' : ''}}>{{$university->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row universityName" @if(empty($mentee['university_name'])) style="display: none;" @endif>
                            <div class="col-md-6">
                                <!-- University -->
                                <div class="{{ $errors->first('university_name')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="text" class="form-control" name="university_name"
                                                   value="{{ old('university_name') != '' ? old('university_name') : $mentee['university_name']}}">
                                            <label for="email">{{trans('messages.university_name')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('university_name') }}</span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- University Department -->
                                <div class="{{ $errors->first('university_department_name')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="text" class="form-control" name="university_department_name"
                                                   value="{{ old('university_department_name') != '' ? old('university_department_name') : $mentee['university_department_name']}}">
                                            <label for="email">{{trans('messages.university_department')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('university_department_name') }}</span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- University graduation year -->
                                <div class="{{ $errors->first('university_graduation_year')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="number" class="form-control" name="university_graduation_year"
                                                   value="{{ old('university_graduation_year') != '' ? old('university_graduation_year') : $mentee['university_graduation_year']}}">
                                            <label for="email">{{trans('messages.university_graduation_year')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('university_graduation_year') }}</span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Linkedin Profile -->
                                <div class="{{ $errors->first('linkedin_url')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="text" class="form-control" name="linkedin_url"
                                                   value="{{ old('linkedin_url') != '' ? old('linkedin_url') : $mentee['linkedin_url']}}">
                                            <label for="email">{{trans('messages.linkedin')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('linkedin_url') }}</span>

                                </div>
                            </div>
                        </div>
                        <div class="row margin-top-20">
                            <div class="col-md-1">
                                <div class="selecterTitle">{{trans('messages.are_you_employed')}}</div>
                            </div>
                            <div class="col-md-5">
                                <input type="checkbox" name="is_employed" {{$mentee['is_employed'] == true ? 'checked' : ''}}>
                            </div><!--.switcher-->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Job Description -->
                                <div class="{{ $errors->first('job_description')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <input type="text" class="form-control" name="job_description"
                                                   value="{{ old('job_description') != '' ? old('job_description') : $mentee['job_description']}}">
                                            <label for="email">{{trans('messages.job_description_form')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('job_description') }}</span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="selecterTitle form-full-row">{{trans('messages.specialty_form_description')}}</div>
                                <select data-placeholder="{{trans('messages.choose_specialties')}}" name="specialty_id" class="chosen-select">
                                    @foreach($specialties as $specialty)
                                        <option value="{{$specialty->id}}" {{$specialty->id == $mentee['specialty_id']? 'selected':''}}>{{$specialty->name}}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('skills') }}</span>
                            </div> <!-- Specialty -->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Specialty Experience -->
                                <div class="{{ $errors->first('specialty_experience')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <textarea required class="form-control js-auto-size" rows="2" name="specialty_experience">{{ old('specialty_experience') != '' ? old('specialty_experience') : $mentee['specialty_experience']}}</textarea>
                                            <label for="specialty_experience">{{trans('messages.specialty_experience_form')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('specialty_experience') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <!-- Expectations -->
                                <div class="{{ $errors->first('expectations')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <textarea required class="form-control js-auto-size" rows="2" name="expectations">{{ old('expectations') != '' ? old('expectations') : $mentee['expectations']}}</textarea>
                                            <label for="expectations">{{trans('messages.expectations_form_placeholder')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('expectations') }}</span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Career goals -->
                                <div class="{{ $errors->first('career_goals')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <textarea required class="form-control js-auto-size" rows="2" name="career_goals">{{ old('career_goals') != '' ? old('career_goals') : $mentee['career_goals']}}</textarea>
                                            <label for="career_goals">{{trans('messages.career_goals_form')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('career_goals') }}</span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Career goals -->
                                <div class="{{ $errors->first('skills')?'has-error has-feedback':'' }}">
                                    <div class="inputer floating-label">
                                        <div class="input-wrapper">
                                            <textarea class="form-control js-auto-size" rows="2" name="skills">{{ old('skills') != '' ? old('skills') : $mentee['skills']}}</textarea>
                                            <label for="skills">{{trans('messages.skills.capitalAll')}}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->first('skills') }}</span>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Reference (where did you hear about us) -->
                                <div class="margin-bottom-5 selecterTitle">{{trans('messages.reference_form')}}</div>
                                <select data-placeholder="select" name="reference_id" class="chosen-select">
                                    <option><!-- Empty option allows the placeholder to take effect. --><option>
                                    @foreach($references as $reference)
                                        <option value="{{$reference->id}}" {{$mentee['reference_id'] == $reference->id ? 'selected' : ''}}>{{$reference->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if($loggedInUser == null)
                            <div class="row font-size-smaller margin-top-20">
                                <div class="col-md-6">
                                    <div class="icheckbox">
                                        <label>
                                            <input type="checkbox" name="terms" required>
                                            {{trans('messages.i_accept_the')}} <a target="_blank" href="http://www.job-pairs.gr/faq/">{{trans('messages.terms_and_conditions')}}</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @elseif($loggedInUser->isAdmin())
                            <div class="row margin-top-10">
                                <!-- CV upload -->
                                <div class="col-md-2">
                                    <div class="file-input-label">
                                        <label for="cv_file">{{trans('messages.upload_cv')}}:</label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-orange btn-file">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="cv_file">
                                        </span>
                                        <span class="fileinput-filename">
                                        @if(!empty($mentee['cv_file_name']))
                                            <a href="{{ url('/') . '/uploads/cv_files/' . $mentee['cv_file_name']}}" target="_blank">
                                                {{ $mentee['cv_file_name'] }}
                                            </a>
                                        @endif
                                        </span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <input name="public_form" type="hidden" value="{{ $loggedInUser == null ? 'true' : 'false'  }}">
                        <div class="row">
                            <div class="col-md-12 submitBtnContainer margin-top-100">
                                <button type="button" class="btn btn-flat-primary">
                                    <a class="cancelTourCreateBtn noStyleLink" href="{{ URL::route('showAllMentees') }}">{{trans('messages.cancel_btn')}}</a>
                                </button>
                                <button type="submit" id="gameFlavorSubmitBtn" class="btn btn-primary btn-ripple margin-left-10">
                                    {{($mentee->id == null ? trans('messages.create_btn') : trans('messages.edit_btn'))}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('additionalFooter')
    <script>
        $( document ).ready(function() {
            var controller = new FormController();
            controller.init();
            var availabilityStatusChangeHandler = new AvailabilityStatusChangeViewHandler();
            availabilityStatusChangeHandler.init("#createMentee");
            var universityHandler = new UniversityHandler();
            universityHandler.initHandler();
        });
    </script>
@endsection
