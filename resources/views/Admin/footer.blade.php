{{-- <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2023 ORDERPOZ. All rights reserved</span>
        </div>
    </div>
</footer> --}}

<div class="footer">
    <div class="row justify-content-between align-items-center">
        <div class="col">
            <p class="font-size-sm mb-0"><span class="d-none d-sm-inline-block">&copy; 2023 ORDERPOZ. All rights reserved.</span>
            </p>
        </div>
        <div class="col-auto">
            <div class="d-flex justify-content-end">
                <!-- List Dot -->
                <ul class="list-inline list-separator">
                    <li class="list-inline-item">
                        <a class="list-separator-link" href="{{route('panel.Detail.other')}}"> {{('Settings')}}</a>
                    </li>

                    <li class="list-inline-item">
                        <!-- Keyboard Shortcuts Toggle -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                               href="{{route('panel.dashboard')}}">
                                <i class="tio-home-outlined"></i>
                            </a>
                        </div>
                        <!-- End Keyboard Shortcuts Toggle -->
                    </li>
                </ul>
                <!-- End List Dot -->
            </div>
        </div>
    </div>
</div>
