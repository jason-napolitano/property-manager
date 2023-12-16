<?php

namespace App\Models {
    use Illuminate\Http\Request;

    class ProjectTask extends Model
    {
        protected $table = 'project_task';

        protected $fillable = [
            'project_id',
            'task_id',
        ];

        /**
         * Add items to a project using the `item_project`
         * pivot table
         *
         * @param Project      $project The project model
         * @param Request|null $request The request object
         *
         * @return void
         */
        public static function add(Project $project, Request $request = null): void
        {
            foreach ($request ? $request['tasks'] : request()->tasks as $task) {
                self::create([
                    'project_id' => $project['id'],
                    'task_id'    => $task,
                ]);
            }
        }

        /**
         * @param Task $task The task model
         *
         * @return void
         */
        public static function remove(Task $task): void
        {
            self::where('task_id', '=', $task['id'])->delete();
        }
    }
}
