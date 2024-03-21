@extends('index')
@section('content')

<ol class="breadcrumb breadcrumb-col-teal align-right" style="margin-top: -20px">
    <li><a href="{{ route('entity') }}"><i class="material-icons">group</i> Entity</a></li>
    <li class="active"><i class="material-icons">account_circle</i> Profile</li>
</ol>
<div class="row clearfix">
    <div class="col-xs-12 col-sm-3">
        <div class="card profile-card">
            <div class="profile-header">&nbsp;</div>
            <div class="profile-body">
                <div class="image-area">
                    @if ($entity->sex == "M")
                        <img src="{{ asset('images/profile-male.jpg') }}" width="160" >
                    @else
                        <img src="{{ asset('images/profile-female.jpg') }}" width="160" >
                    @endif
                </div>
                <div class="content-area">
                    <h3>{{ ($entity->entityname) ? strtoupper($entity->entityname) : strtoupper($entity->firstname.' '.$entity->lastname) }}</h3>
                    <p>{{ ($entity->contact_number) }}</p>
                    <p>{{ ($entity->email)}}</p>
                </div>
            </div>
            <div class="profile-footer">
                <ul>
                    <li>
                        <span>Purok</span>
                        <span>{{ strtoupper($entity->purok) }}</span>
                    </li>
                    <li>
                        <span>Barangay</span>
                        <span>{{ strtoupper($entity->barangay()->first()->description) }}</span>
                    </li>
                    <li>
                        <span>Municipality / City</span>
                        <span>{{ strtoupper($entity->town()->first()->description) }}</span>
                    </li>
                    <li>
                        <span>Province</span>
                        <span>{{ strtoupper($entity->province()->first()->description) }}</span>
                    </li>
                </ul>
                <button class="btn btn-primary btn-lg waves-effect btn-block">FOLLOW</button>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-9">
        <div class="card">
            <div class="body">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                        <li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                        <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                            <div class="panel panel-default panel-post">
                                <div class="panel-heading">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                <img src="../../images/user-lg.jpg">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                <a href="#">Marc K. Hammond</a>
                                            </h4>
                                            Shared publicly - 26 Oct 2018
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="post">
                                        <div class="post-heading">
                                            <p>I am a very simple wall post. I am good at containing <a href="#">#small</a> bits of <a href="#">#information</a>. I require little more information to use effectively.</p>
                                        </div>
                                        <div class="post-content">
                                            <img src="../../images/profile-post-image.jpg" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="material-icons">thumb_up</i>
                                                <span>12 Likes</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="material-icons">comment</i>
                                                <span>5 Comments</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="material-icons">share</i>
                                                <span>Share</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Type a comment">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div role="tabpanel" class="tab-pane fade in" id="profile_settings">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="NameSurname" class="col-sm-2 control-label">Name Surname</label>
                                    <div class="col-sm-10">
                                        <div class="form-line focused">
                                            <input type="text" class="form-control" id="NameSurname" name="NameSurname" placeholder="Name Surname" value="Marc K. Hammond" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Email" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <div class="form-line focused">
                                            <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" value="example@example.com" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputExperience" class="col-sm-2 control-label">Experience</label>

                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <textarea class="form-control" id="InputExperience" name="InputExperience" rows="3" placeholder="Experience"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="InputSkills" class="col-sm-2 control-label">Skills</label>

                                    <div class="col-sm-10">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="InputSkills" name="InputSkills" placeholder="Skills">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="checkbox" id="terms_condition_check" class="chk-col-red filled-in">
                                        <label for="terms_condition_check">I agree to the <a href="#">terms and conditions</a></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="Old Password" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="New Password" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                    <div class="col-sm-9">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="NewPasswordConfirm" name="NewPasswordConfirm" placeholder="New Password (Confirm)" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-danger">SUBMIT</button>
                                    </div>
                                </div>
                            </form>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    
</script>
@endpush