<!-- Country-selector modal-->
<div class="modal fade" id="country-selector">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content country-select-modal">
            <div class="modal-header">
                <h6 class="modal-title">{{__('main.changeLang')}}</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <ul class="row p-3">
                    @foreach(LaravelLocalization::getSupportedLocales() as $key => $data)
                        <li class="col-lg-6 mb-2">
                            @php
                                $icon = $data['icon'];
                            @endphp
                            <a href="{{ LaravelLocalization::getLocalizedURL("$key") }}"
                               class="btn btn-country btn-lg btn-block @if(App::getLocale() == $key) active @endif">
                                <span class="country-selector"><img alt="" src="{{ asset("assets/admin/images/flags/$icon") }}" class="me-3 language"> </span>
                                {{ $data['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
