<?php

namespace Ownego\RoleSelect;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasPermissions;

class RoleSelect extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'role-select';

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $roleClass = app(PermissionRegistrar::class)->getRoleClass();
        $roles = $roleClass::all();
        $this->withMeta(['roles' => $roles]);
    }

    /**
     * @param NovaRequest $request
     * @param string $requestAttribute
     * @param HasPermissions $model
     * @param string $attribute
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if (! $request->exists($requestAttribute)) {
            return;
        }

        $model->roles()->detach();

        collect(json_decode($request[$requestAttribute], true))
            ->map(static function ($roleName) use ($model) {
                $roleClass = app(PermissionRegistrar::class)->getRoleClass();
                $role = $roleClass::where('name', $roleName)->first();
                $model->assignRole($role);

                return $roleName;
            });
    }
}
