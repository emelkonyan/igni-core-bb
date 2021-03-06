<?php

namespace Despark\Cms\Console\Commands\Compilers;

/**
 * Class PageCompiler.
 */
class PageCompiler
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var string
     */
    protected $fullTableName;

    /**
     * @var array
     */
    protected $modelReplacements = [
        ':app_namespace' => '',
        ':table_name' => '',
        ':full_table_name' => '',
    ];

    /**
     * @var array
     */
    protected $entitiesReplacements = [
        ':app_namespace' => '',
    ];

    /**
     * @var array
     */
    protected $controllerReplacements = [
        ':app_namespace' => '',
    ];

    /**
     * @var array
     */
    protected $requestReplacements = [
        ':app_namespace' => '',
    ];

    /**
     * @var array
     */
    protected $migrationReplacements = [
        ':table_name' => '',
        ':migration_class' => '',
    ];

    /**
     * @param Command $command
     * @param         $identifier
     * @param         $options
     *
     * @todo why setting options where we can get it from command? Either remove command or keep options
     */
    public function __construct($tableName, $fullTableName)
    {
        $this->tableName = $tableName;
        $this->fullTableName = $fullTableName;
    }

    /**
     * @param $template
     *
     * @return string
     *
     * @throws \Exception
     */
    public function render_model($template)
    {
        $this->modelReplacements[':app_namespace'] = app()->getNamespace();
        $this->modelReplacements[':table_name'] = $this->tableName;
        $this->modelReplacements[':full_table_name'] = $this->fullTableName;

        $template = strtr($template, $this->modelReplacements);

        return $template;
    }

    /**
     * @param $template
     *
     * @return string
     */
    public function render_entities($template)
    {
        $this->entitiesReplacements[':app_namespace'] = app()->getNamespace();
        $this->entitiesReplacements[':table_name'] = $this->tableName;

        $template = strtr($template, $this->entitiesReplacements);

        return $template;
    }

    /**
     * @param $template
     *
     * @return string
     */
    public function render_controller($template)
    {
        $this->controllerReplacements[':app_namespace'] = app()->getNamespace();

        $template = strtr($template, $this->controllerReplacements);

        return $template;
    }

    /**
     * @param $template
     *
     * @return string
     */
    public function render_request($template)
    {
        $this->requestReplacements[':app_namespace'] = app()->getNamespace();

        $template = strtr($template, $this->requestReplacements);

        return $template;
    }

    /**
     * @param $template
     *
     * @return string
     */
    public function render_migration($template)
    {
        $this->migrationReplacements[':table_name'] = str_plural($this->tableName);
        $this->migrationReplacements[':migration_class'] = 'Create'.str_plural(studly_case($this->tableName)).'Table';

        $template = strtr($template, $this->migrationReplacements);

        return $template;
    }
}
