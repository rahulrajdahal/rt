<div class="news">
    <h1>Contact Us</h1><br>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="redCard">
                <div>
                    <i class="far fa-map-marker"></i><br>
                    <strong>LOCATION</strong> <br>
                    {{ $settings->location ?? 'Location has not been set.' }}
                </div><br><br>
                <div>
                    <i class="far fa-envelope"></i><br>
                    <strong>EMAIL ADDRESS</strong> <br>
                    {{ $settings->email ?? 'Email has not been set.' }}
                </div><br><br>
                <div>
                    <i class="far fa-phone"></i><br>
                    <strong>PHONE NUMBER</strong> <br>
                    {{ $settings->phone ?? 'Phone number has not been set.' }}
                </div>
            </div>
        </div>
    </div>
    
        <iframe class ="map" height="100%" width="100%"  id="gmap_canvas" src="https://maps.google.com/maps?q=artreenepal&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
</div>