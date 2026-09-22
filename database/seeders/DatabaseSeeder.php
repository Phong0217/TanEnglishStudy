<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Assignment;
use App\Models\AssignmentDelivery;
use App\Models\AssignmentItem;
use App\Models\AssignmentVersion;
use App\Models\Center;
use App\Models\Classroom;
use App\Models\ClassroomTeacher;
use App\Models\Course;
use App\Models\CourseVersion;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\LessonBlock;
use App\Models\LessonVersion;
use App\Models\Question;
use App\Models\QuestionVersion;
use App\Models\StudentProfile;
use App\Models\Submission;
use App\Models\SubmissionAnswer;
use App\Models\TeacherProfile;
use App\Models\Unit;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);
        $center = Center::create(['name' => 'English Center LMS', 'code' => 'MAIN', 'timezone' => 'Asia/Bangkok', 'status' => 'ACTIVE']);
        $admin = User::create(['center_id' => $center->id, 'name' => 'Center Admin', 'email' => 'admin@example.com', 'password' => 'password', 'status' => 'ACTIVE', 'email_verified_at' => now()]);
        $admin->assignRole(RoleName::ADMIN->value);

        $teachers = collect(range(1, 2))->map(function (int $number) use ($center) {
            $user = User::create(['center_id' => $center->id, 'name' => "Teacher {$number}", 'email' => "teacher{$number}@example.com", 'password' => 'password', 'status' => 'ACTIVE', 'email_verified_at' => now()]);
            $user->assignRole(RoleName::TEACHER->value);
            TeacherProfile::create(['user_id' => $user->id, 'teacher_code' => sprintf('T%03d', $number), 'specialization' => $number === 1 ? 'Grammar' : 'Speaking', 'joined_at' => now()]);

            return $user;
        });
        $students = collect(range(1, 10))->map(function (int $number) use ($center) {
            $user = User::create(['center_id' => $center->id, 'name' => "Student {$number}", 'email' => "student{$number}@example.com", 'password' => 'password', 'status' => 'ACTIVE', 'email_verified_at' => now()]);
            $user->assignRole(RoleName::STUDENT->value);
            StudentProfile::create(['user_id' => $user->id, 'student_code' => sprintf('S%03d', $number), 'joined_at' => now(), 'parent_name' => "Parent {$number}"]);

            return $user;
        });

        $courses = collect([['ENG-G5', 'English Grade 5', 5], ['ENG-G8', 'English Grade 8', 8]])->map(function (array $data) use ($center, $admin) {
            $course = Course::create(['center_id' => $center->id, 'code' => $data[0], 'title' => $data[1], 'grade_level' => $data[2], 'cefr_level' => $data[2] < 7 ? 'A2' : 'B1', 'status' => 'PUBLISHED', 'created_by' => $admin->id, 'published_at' => now()]);
            $version = CourseVersion::create(['course_id' => $course->id, 'code' => 'FA26', 'title' => 'Fall 2026', 'version_number' => '1.0', 'status' => 'PUBLISHED', 'start_date' => now()->startOfMonth(), 'end_date' => now()->addMonths(4), 'published_at' => now(), 'created_by' => $admin->id]);
            foreach (range(1, 2) as $unitPosition) {
                $unit = Unit::create(['course_version_id' => $version->id, 'title' => "Unit {$unitPosition}", 'description' => 'Core language and communication skills.', 'learning_objectives_json' => ['Read confidently', 'Use target vocabulary'], 'position' => $unitPosition, 'status' => 'PUBLISHED', 'created_by' => $admin->id]);
                foreach (range(1, 2) as $lessonPosition) {
                    $lesson = Lesson::create(['unit_id' => $unit->id, 'title' => "Lesson {$lessonPosition}: Everyday English", 'description' => 'Reading, vocabulary, and comprehension practice.', 'estimated_duration_minutes' => 35, 'position' => $lessonPosition, 'status' => 'PUBLISHED', 'lock_version' => 1, 'created_by' => $admin->id, 'published_at' => now()]);
                    $lessonVersion = LessonVersion::create(['lesson_id' => $lesson->id, 'version_number' => 1, 'title_snapshot' => $lesson->title, 'description_snapshot' => $lesson->description, 'instructions_snapshot' => $lesson->instructions, 'learning_objectives_json' => $lesson->learning_objectives_json, 'status' => 'PUBLISHED', 'lock_version' => 1, 'created_by' => $admin->id, 'published_at' => $lesson->published_at]);
                    $lesson->update(['published_version_id' => $lessonVersion->id]);
                    LessonBlock::create(['lesson_id' => $lesson->id, 'lesson_version_id' => $lessonVersion->id, 'block_type' => 'heading', 'content_json' => ['text' => "Everyday English {$lessonPosition}", 'level' => 2], 'position' => 1, 'grading_mode' => 'AUTO']);
                    LessonBlock::create(['lesson_id' => $lesson->id, 'lesson_version_id' => $lessonVersion->id, 'block_type' => 'rich_text', 'content_json' => ['html' => '<p>Read the passage carefully and complete the activity.</p>'], 'position' => 2, 'grading_mode' => 'AUTO']);
                    LessonBlock::create(['lesson_id' => $lesson->id, 'lesson_version_id' => $lessonVersion->id, 'block_type' => 'multiple_choice', 'content_json' => ['prompt' => 'Which greeting is appropriate in the morning?', 'options' => [['id' => 'a', 'text' => 'Good morning'], ['id' => 'b', 'text' => 'Good night'], ['id' => 'c', 'text' => 'Goodbye']]], 'answer_key_json' => ['correctOptionId' => 'a'], 'points' => 1, 'position' => 3, 'required' => true, 'grading_mode' => 'AUTO']);
                }
            }

            return $course->load('versions.units.lessons.blocks');
        });

        $classrooms = $courses->values()->map(function (Course $course, int $index) use ($center, $admin, $teachers, $students) {
            $teacher = $teachers[$index];
            $classroom = Classroom::create(['center_id' => $center->id, 'course_version_id' => $course->versions->first()->id, 'primary_teacher_id' => $teacher->id, 'name' => 'Class '.chr(65 + $index), 'code' => 'CLASS-'.chr(65 + $index), 'status' => 'ACTIVE', 'start_date' => now(), 'end_date' => now()->addMonths(4), 'created_by' => $admin->id]);
            ClassroomTeacher::create(['classroom_id' => $classroom->id, 'teacher_id' => $teacher->id, 'assignment_role' => 'TEACHER', 'status' => 'ACTIVE', 'assigned_by' => $admin->id, 'assigned_at' => now()]);
            $students->slice($index * 5, 5)->each(fn (User $student) => Enrollment::create(['classroom_id' => $classroom->id, 'student_id' => $student->id, 'status' => 'ACTIVE', 'enrolled_at' => now(), 'created_by' => $admin->id]));

            return $classroom;
        });

        $question = Question::create(['center_id' => $center->id, 'type' => 'multiple_choice', 'skill' => 'READING', 'difficulty' => 'EASY', 'status' => 'APPROVED', 'created_by' => $teachers[0]->id]);
        $questionVersion = QuestionVersion::create(['question_id' => $question->id, 'version_number' => 1, 'content_json' => ['prompt' => 'Choose the polite request.', 'options' => [['id' => 'a', 'text' => 'Please help me.'], ['id' => 'b', 'text' => 'Help now!'], ['id' => 'c', 'text' => 'No.']]], 'answer_key_json' => ['correctOptionId' => 'a'], 'settings_json' => [], 'explanation' => 'Please makes a request polite.', 'created_by' => $teachers[0]->id]);
        $assignment = Assignment::create(['center_id' => $center->id, 'title' => 'Polite English Check', 'description' => 'A short reading checkpoint.', 'status' => 'PUBLISHED', 'created_by' => $teachers[0]->id]);
        $assignmentVersion = AssignmentVersion::create(['assignment_id' => $assignment->id, 'version_number' => 1, 'instructions' => 'Choose the best answer.', 'total_points' => 1, 'is_locked' => true, 'published_at' => now(), 'created_by' => $teachers[0]->id]);
        $item = AssignmentItem::create(['assignment_version_id' => $assignmentVersion->id, 'question_version_id' => $questionVersion->id, 'item_type' => 'multiple_choice', 'content_snapshot_json' => $questionVersion->content_json, 'answer_key_snapshot_json' => $questionVersion->answer_key_json, 'settings_snapshot_json' => [], 'explanation_snapshot' => $questionVersion->explanation, 'points' => 1, 'position' => 1]);
        $delivery = AssignmentDelivery::create(['assignment_version_id' => $assignmentVersion->id, 'classroom_id' => $classrooms[0]->id, 'status' => 'OPEN', 'open_at' => now()->subDay(), 'due_at' => now()->addDays(7), 'close_at' => now()->addDays(8), 'max_attempts' => 2, 'result_release_policy' => 'AFTER_GRADING', 'assigned_by' => $teachers[0]->id]);
        $submission = Submission::create(['assignment_delivery_id' => $delivery->id, 'student_id' => $students[0]->id, 'attempt_number' => 1, 'status' => 'GRADED', 'started_at' => now()->subHour(), 'submitted_at' => now()->subMinutes(30)]);
        SubmissionAnswer::create(['submission_id' => $submission->id, 'assignment_item_id' => $item->id, 'response_json' => ['selectedOptionId' => 'a'], 'auto_score' => 1, 'final_score' => 1, 'grading_status' => 'AUTO_GRADED', 'graded_at' => now()]);
        Grade::create(['submission_id' => $submission->id, 'auto_score' => 1, 'final_score' => 1, 'status' => 'RELEASED', 'general_feedback' => 'Excellent work.', 'graded_by' => $teachers[0]->id, 'graded_at' => now(), 'released_at' => now()]);
        $students[0]->notify(new SystemNotification('Grade released', 'Your Polite English Check grade is ready.', '/student/grades'));
        $teachers[0]->notify(new SystemNotification('Class assigned', 'You are the primary teacher for Class A.', '/teacher/classes'));
    }
}
