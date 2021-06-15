 <div class="{{$mainClass}} mt-2">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <p class="mb-2">{{$title}}</p>
                                                    <h4 class="mb-0">{{$total}}</h4>
                                                </div>
                                                <div class="col-4">
                                                    <div class="text-right">
                                                        <div>
                                                            {{$percentage}} <i class="mdi mdi-arrow-up text-success ml-1"></i>
                                                        </div>
                                                        <div class="progress progress-sm mt-3">
                                                            <div class="{{$pClass}}" role="progressbar" style="width: 62%" aria-valuenow="{{ $pValue }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
