@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-indigo">
                <div class="panel-heading">
                    <h4>User Accounts</h4>
                    <div class="options">
                        <a href="javascript:;"><i class="fa fa-cog"></i></a>
                        <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th class="col-xs-9 col-sm-3">User ID</th>
                                    <th class="col-sm-6 hidden-xs">Email Address</th>
                                    <th class="col-xs-2 col-sm-2">Status</th>
                                </tr>
                            </thead>
                            <tbody class="selects">
                                <tr>
                                    <td>cranston</td>
                                    <td class="hidden-xs">cranstonb@gnail.com</td>
                                    <td><span class="label label-success">Approved</span></td>
                                </tr>
                                <tr>
                                    <td>aaron</td>
                                    <td class="hidden-xs">ppaul@lime.com</td>
                                    <td><span class="label label-grape">Pending</span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                   <th class="col-xs-9 col-sm-3">User ID</th>
                                   <th class="col-sm-6 hidden-xs">Email Address</th>
                                   <th class="col-xs-2 col-sm-2">Status</th>
                               </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-midnightblue">

                <div class="panel-heading">
                      <h4>
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#threads" data-toggle="tab"><i class="fa fa-list visible-xs icon-scale"></i><span class="hidden-xs">Threads</span></a></li>
                          <li><a href="#comments" data-toggle="tab"><i class="fa fa-comments visible-xs icon-scale"></i><span class="hidden-xs">Comments</span></a></li>
                          <li><a href="#users" data-toggle="tab"><i class="fa fa-group visible-xs icon-scale"></i><span class="hidden-xs">Users</span></a></li>
                        </ul>
                      </h4>
                </div>

                <div class="panel-body">
                    <div class="tab-content">

                        <div class="tab-pane active" id="threads">
                            <ul class="panel-threads">
                                <li>
                                    <img src="assets/demo/avatar/aniss.png" alt="Aniss">
                                    <div class="content">
                                        <span class="time">20 mins</span>
                                        <a href="#" class="title">Envato’s Most Wanted – $5,000 Reward for Music & Band Themes and Templates</a>
                                        <span class="thread">asked by <a href="#">Jim Gordon</a> in <a href="#">Section #3</a></span>
                                    </div>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-default-alt btn-sm pull-right">Load More</a>
                        </div>
                        <div class="tab-pane" id="comments">
                            <ul class="panel-comments">
                                <li>
                                    <img src="assets/demo/avatar/aniss.png" alt="Aniss">
                                    <div class="content">
                                        <span class="actions"><div class="options"><div class="btn-group"><button class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></button><button class="btn btn-default btn-xs"><i class="fa fa-times"></i></button></div></div></span>
                                        <span class="commented"><a href="#">Jim Gordon</a> commented on <a href="#">Article #121</a></span>
                                        Just wondering - can random users see our comments? If so, allow them to comment!
                                    </div>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-default-alt btn-sm pull-right">Load More</a>
                        </div>
                        <div class="tab-pane" id="users">
                            <ul class="panel-users">
                                <li>
                                    <img src="assets/demo/avatar/paton.png" alt="Paton">
                                    <div class="content">
                                        <span class="time">11 mins</span>
                                        <span class="desc"><a href="#">Polly Paton</a> followed <a href="#">John White</a></span>
                                    </div>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-default-alt btn-sm pull-right">Load More</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

@stop