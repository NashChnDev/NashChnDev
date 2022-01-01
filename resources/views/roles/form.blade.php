
<div class="form-group clearfix {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-3 col-sm-6 control-label">Name*</label>
    <div class="col-md-9 col-sm-6 float-right">
        <input class="form-control " name="name" type="text" id="name" value="{{ old('name', optional($role)->name) }}" minlength="1" ng-model="mRoleName" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<input id="guard_name_web" class="" name="guard_name" type="hidden" value="web">

    <div class="form-group clearfix {{ $errors->has('guard_name') ? 'has-error' : '' }}">
    <label for="guard_name" class="col-md-3 col-sm-6 control-label">Role For*</label>
    <div class="col-md-9 col-sm-6 float-right">
        <div class="radio">
            <label for="guard_name_web">
                <input id="guard_name_web" class="" name="guard_name" type="radio" value="web" ng-change="getPermission()" {{ old('guard_name', optional($role)->guard_name) == 'web' ? 'checked' : '' }} ng-model="mRoleFor">
                Web Application
            </label>
        </div>
        <div class="radio">
            <label for="guard_name_api">
                <input id="guard_name_api" class="" name="guard_name" type="radio" value="api" {{ old('guard_name', optional($role)->guard_name) == 'api' ? 'checked' : '' }} ng-change="getPermission()" ng-model="mRoleFor">
                Mobile Application
            </label>
        </div>

        {!! $errors->first('guard_name', '<p class="help-block">:message</p>') !!}
    </div>
</div> 
<div class="col-12" ng-show="mRoleFor=='web'">
    <div class="card card-primary card-outline">
                     <div class="card-header">
                            <h3 class="card-title clearfix">
                               Permissions*
                            </h3>
                        </div>
                        <div class="card-body table-responsive">
                            <label class="control-label">Master Permissions</label>
                            <table class="table table-striped">
                                <thead><tr>
                                    <td >Permissions</td>
                                    <td  class="text-center">Create<br/> <input type="checkbox" ng-model="checkall_create" ng-change="AllowCreate()"/></td>
                                    <td class="text-center">View<br/> <input type="checkbox" ng-model="checkall_view" ng-change="AllowView()"/></td>
                                    <td class="text-center">Edit<br/> <input type="checkbox" ng-model="checkall_edit" ng-change="AllowEdit()"/></td>
                                    <td class="text-center">Delete<br/> <input type="checkbox" ng-model="checkall_delete" ng-change="AllowDelete()"/></td>
                                </tr></thead>
                                <tbody>
                                    <tr ng-repeat="permission in master_permissions">
                                        <td>
                                            <b ng-bind="permission.key"></b>
                                        </td>
                                        <td class="text-center" ><input type="checkbox" name="permission_flag[]" ng-model="permission.create_permission.is_checked" ng-value="permission.create_permission.id"/>
                                        </td>
                                        <td class="text-center" ><input type="checkbox" name="permission_flag[]" ng-model="permission.view_permission.is_checked" ng-value="permission.view_permission.id"/>
                                        </td>
                                        <td class="text-center" ><input type="checkbox" name="permission_flag[]" ng-model="permission.edit_permission.is_checked" ng-value="permission.edit_permission.id"/>
                                        </td>
                                        <td class="text-center" ><input type="checkbox" name="permission_flag[]" ng-model="permission.delete_permission.is_checked" ng-value="permission.delete_permission.id"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br/>
                            {{-- <label class="control-label">Other Permissions</label>
                            <table class="table table-striped">
                                <thead><tr>
                                    <td>Permissions</td>
                                    <td class="text-center">Action<br/>
                                    <input ng-model="checkall_permission" type="checkbox" ng-change="AllowPermission()"/>
                                    </td>
                                </tr></thead>
                                <tbody>
                                    <tr ng-repeat="permission in screen_permissions">
                                        <td>
                                            <b ng-bind="permission.key"></b>
                                        </td>
                                        <td class="text-center"><input type="checkbox" name="permission_flag[]" ng-model="permission.permission.is_checked" ng-value="permission.permission.id"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> --}}
                        </div>
</div>
</div>
