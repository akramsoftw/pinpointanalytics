@extends('layouts.app')

@section('header_extra')
    <meta name="page" content="settings" initial="settings">
@endsection

@section('content')

@include('layouts.parts.nav-2')
@include('layouts.parts.navbar')

    <div class="py-main">
        <div class="container container-sm">
            <div class="heading my-3 my-lg-4">
                <h1>Settings</h1>
            </div>
            <div class="box-general diff-so shadow">
                <div class="heading">
                    <h3>App Settings</h3>
                </div>
                <div class="list-setting">
                    <div class="list-left">
                        <div class="heading">
                            <h4>Logo</h4>
                            <!-- <p>Duis vitae ornare sem. Nullam elit sapien, suscipit</p> -->
                        </div>
                    </div>
                    <div class="list-right">
                        <div class="fileUpload btn">
                            <img src="{{ asset('frontend/img/pinpoint/icon/ic-photo.svg') }}" class="img-fluid" alt="Icon">
                            <span class="text-truncate">Upload Logo</span>
                            <input type="file" class="uploadlogo" onchange="saveFile(this)" />
                        </div>
                    </div>
                </div>
                <!-- <div class="list-setting">
                    <div class="list-left">
                        <div class="heading">
                            <h4>Schedule</h4>
                            <p>Suscipit et felis a, semper elementum urna. Proin facilisis velit a erat vestibulum</p>
                        </div>
                    </div>
                    <div class="list-right">
                        <div class="fileUpload btn">
                            <img src="{{ asset('frontend/img/pinpoint/icon/ic-upload.svg') }}" class="img-fluid" alt="Icon">
                            <span class="text-truncate">Upload Schedule</span>
                            <input type="file" class="uploadlogo" />
                        </div>
                    </div>
                </div> -->
                <!-- <div class="list-setting">
                    <div class="list-left">
                        <div class="heading">
                            <h4>Choose Color</h4>
                            <p>Suscipit et felis a, semper elementum urna. Proin facilisis velit a erat vestibulum</p>
                        </div>
                    </div>
                    <div class="list-right">
                        <div class="list-flex">
                            <div class="btn btn-border default">Default</div>
                            <div class="btn btn-primary diff">Team Branded</div>
                        </div>
                    </div>
                </div> -->
            </div>
            
            <div class="box-general diff-so shadow">
                <div class="heading">
                    <h3>User Settings</h3>
                </div>
                <!-- <h5>List of Users</h5> -->
                <!-- <div class="list-setting diff">
                    <div class="list-left">
                        <div class="heading">
                            <h4>User <strong>#1</strong></h4>
                        </div>
                    </div>
                    <div class="list-right">
                        <div class="list-flex">
                            <label class="form-check btn btn-border default" for="shots1">
                                <input class="form-check-input checkbox-custom" type="checkbox" id="shots1" value="option1">
                                <div class="form-check-label">Shots</div>
                            </label>
                            <label class="form-check btn btn-border default" for="stats1">
                                <input class="form-check-input checkbox-custom" type="checkbox" id="stats1" value="option1">
                                <div class="form-check-label">Stats</div>
                            </label>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="list-setting diff">
                    <div class="list-left">
                        <div class="heading">
                            <h4>User <strong>#2</strong></h4>
                        </div>
                    </div>
                    <div class="list-right">
                        <div class="list-flex">
                            <label class="form-check btn btn-border default" for="shots2">
                                <input class="form-check-input checkbox-custom" type="checkbox" id="shots2" value="option1">
                                <div class="form-check-label">Shots</div>
                            </label>
                            <label class="form-check btn btn-border default" for="stats2">
                                <input class="form-check-input checkbox-custom" type="checkbox" id="stats2" value="option1">
                                <div class="form-check-label">Stats</div>
                            </label>
                        </div>
                    </div>
                </div> -->
                <div class="list-setting">
                    <div class="list-left">
                        <div class="heading">
                            <h4>Manage Users</h4>
                            <p></p>
                        </div>
                    </div>
                    <div class="list-right">
                        <div class="list-flex">
                            <a href="{{route('users.index')}}" class="btn btn-border default">User Settings</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="box-general diff-so shadow">
                <div class="heading">
                    <h3>Data Settings</h3>
                </div>
                <div class="list-setting">
                    <div class="list-left">
                        <div class="heading">
                            <h4>Backup Data</h4>
                            <p>Duis vitae ornare sem. Nullam elit sapien, suscipit</p>
                        </div>
                    </div>
                    <div class="list-right">
                        <div class="btn btn-border export">
                            <img src="{{ asset('frontend/img/pinpoint/icon/ic-download.svg') }}" class="img-fluid" alt="Icon">
                            <span class="text-truncate">Export Data</span>
                        </div>
                    </div>
                </div>
                <div class="list-setting">
                    <div class="list-left">
                        <div class="heading">
                            <h4>Restore Data</h4>
                            <p>Suscipit et felis a, semper elementum urna. Proin facilisis velit a erat vestibulum</p>
                        </div>
                    </div>
                    <div class="list-right">
                        <div class="fileUpload btn">
                            <img src="{{ asset('frontend/img/pinpoint/icon/ic-upload.svg') }}" class="img-fluid" alt="Icon">
                            <span class="text-truncate">Upload Data</span>
                            <input type="file" class="uploadlogo" />
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="mt-4 mb-5">
                <button class="btn btn-primary btn-submit-setting">Save</button>
                <div class="clearfix"></div>
            </div> -->
        </div>
    </div>
@endsection

@section('footer_extra')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        // You can modify the upload files to pdf's, docs etc
        //Currently it will upload only images

        $(document).ready(function($) {

        // Upload btn on change call function
        $(".uploadlogo").change(function() {
            var filename = readURL(this);
            $(this).parent().children('span').html(filename);

        });

        $(".form-check-input").click(function() {
            if ($(this).is(':checked')) {
                $(this).parent().addClass("active");
            } else {
                $(this).parent().removeClass("active");
            }
        })

        // Read File and return value  
        function readURL(input) {
            var url = input.value;
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (
                ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "gif" || ext == "pdf"
                )) {
                var path = $(input).val();
                var filename = path.replace(/^.*\\/, "");
                // $('.fileUpload span').html('Uploaded Proof : ' + filename);
                return filename;
                // return "Uploaded file : "+filename;
            } else {
                $(input).val("");
                return "Image/pdf formats";
            }
        }
        // Upload btn end

        });

        async function saveFile(inp) 
        {
            let formData = new FormData();           
            formData.append("_token", CSRF_TOKEN);
            formData.append("file", inp.files[0]);
            await fetch("{{route('settings_logo_upload')}}", {method: "POST", body: formData});    
            alert('success');
        }
    </script>
@endsection