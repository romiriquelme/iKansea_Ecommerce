<br>
<img class="card-img-top mb-3" style="border-radius: 50%;" src="{{ (!empty($adminData->profile_photo_path))? url('upload/admin_images/'.$adminData->profile_photo_path):url('upload/no_image.jpg') }}"
                width="100%" height="100%">
                <li class="list-group list-group-flush">
                    <a href="{{ route('index') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{ route('my.order') }}" class="btn btn-primary btn-sm btn-block">Orders</a>
                    <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </li>