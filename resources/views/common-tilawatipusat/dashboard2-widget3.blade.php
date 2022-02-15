<div class="card" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div>
                                    <p class="text-muted font-weight-medium mt-1 mb-2">{{ $title }}</p>
                                    <h4>{{ $total }}</h4>
                                </div>
                            </div>

                            <div class="col-4">
                                <div>
                                    <div id="{{ $chartId }}"></div>
                                </div>
                            </div>
                        </div>
                        <div>
                             @yield('from3')
                        </div>
                    </div>
                </div>
                   