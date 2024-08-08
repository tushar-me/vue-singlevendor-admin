
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7302.215517549836!2d90.39376169443128!3d23.779176777948532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c77055555555%3A0xcfb6cac3eb68c145!2z4Kau4Ka54Ka-4KaW4Ka-4Kay4KeAIOCmleCmvuCmgeCmmuCmviDgpqzgpr7gppzgpr7gprA!5e0!3m2!1sbn!2sbd!4v1704970944097!5m2!1sbn!2sbd"
                                width="600" height="450" style="border:0;"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
