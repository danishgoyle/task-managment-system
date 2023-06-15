<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_tasks()
    {
        $tasks = Task::factory()->count(3)->create();

        $response = $this->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertViewIs('tasks.index');
        $response->assertViewHas('tasks', $tasks);
    }

    public function test_can_create_task()
    {
        $data = [
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'completed' => true,
        ];

        $response = $this->post(route('tasks.store'), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_can_update_task()
    {
        $task = Task::factory()->create();

        $data = [
            'title' => 'Updated Task',
            'description' => 'This is an updated task',
            'completed' => true,
        ];

        $response = $this->put(route('tasks.update', $task->id), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_can_delete_task()
{
    $task = Task::factory()->create();

    $response = $this->delete(route('tasks.destroy', $task->id));

    $response->assertStatus(302);
    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
}
}
