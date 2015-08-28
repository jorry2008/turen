<?php

namespace backend\components;

use Yii;

// use yii\helpers\ArrayHelper;

/**
 * This class represents an access rule defined by the [[AccessControl]] action filter
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AccessRule extends \yii\filters\AccessRule
{
    /**
     * Checks whether the Web user is allowed to perform the specified action.
     * @param Action $action the action to be performed
     * @param User $user the user object
     * @param Request $request
     * @return boolean|null true if the user is allowed, false if the user is denied, null if the rule does not apply to the user
     */
    public function allows($action, $user, $request)
    {
        if ($this->matchAction($action)
            && $this->matchRole($user, $action)//使用新的角色控制
            && $this->matchIP($request->getUserIP())
            && $this->matchVerb($request->getMethod())
            && $this->matchController($action->controller)
            && $this->matchCustom($action)
        ) {
            return $this->allow ? true : false;
        } else {
            return null;
        }
    }

    /**
     * @param User $user the user object
     * @return boolean whether the rule applies to the role
     */
    protected function matchRole($user, $action='')
    {
        if (empty($this->roles)) {
            return true;
        }
        
        //超级管理员直接通过（从过滤器上传递过来的^_^,不为空，所以下面的role规则将激活）
        if (!$user->getIsGuest() && $user->getIdentity()->is_admin) {
            return true;
        }

        $route = [];
        /*
        $route = [];
        $route[] = $action->controller->module->id;
        $route[] = $action->controller->id;
        $route[] = $action->id;
        $route = strtolower(implode('/', $route));
        */
        
        $route = Yii::$app->requestedRoute;
        $this->roles = [$route];
        
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } elseif ($user->can($role)) {
                return true;
            }
        }

        return false;
    }
}
