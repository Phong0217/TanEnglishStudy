# AI PDF → Lesson Builder

## Phân tích file `BỘ ĐỀ GV TPHD - in 31 bản.pdf`

Tài liệu gồm 49 trang và nhiều bộ đề ôn tập. Cấu trúc lặp lại được nhận diện là:

- **A – Vocabulary & Grammar / Language**: câu chọn đáp án, điền từ trong quảng cáo/thông báo và ngữ pháp.
- **B – Reading**: bài cloze và đọc hiểu trắc nghiệm (thường các nhóm câu 23–35).
- **C – Writing**: sắp xếp câu, chọn câu gần nghĩa và kết hợp câu (thường các nhóm câu 36–50).

Không thấy phần Listening hoặc Speaking trong nội dung trích xuất. Hệ thống không tạo dữ liệu giả cho hai kỹ năng này; chúng chỉ xuất hiện khi nguồn tài liệu thực sự có nội dung tương ứng.

## Luồng dữ liệu thật

1. Upload PDF qua `SourceDocument` và parser hiện tại.
2. Parser tạo `DocumentChunk` theo trang/section.
3. `GenerateQuestionsJob` gọi provider AI, kiểm chứng bằng `EnglishQuestionValidator`, lưu `Question` + `QuestionVersion` + nguồn trích dẫn.
4. Giáo viên/Admin duyệt câu hỏi trong AI Review.
5. Chọn Lesson đích và bấm **Thêm vào Lesson**. Backend trong transaction tạo block trong bản nháp, giữ `question_version_id` và metadata skill/category/source.
6. Giáo viên kiểm tra/chỉnh sửa trong Lesson Builder, lưu và xuất bản.
7. Dùng nút **Phân công** hiện tại để tạo delivery cho nhiều lớp. Assignment snapshot hiện có sẽ dùng đúng published LessonVersion.

## Mapping

| AI type | Lesson block | Grading |
| --- | --- | --- |
| `multiple_choice` | Multiple choice | AUTO |
| `multiple_select` | Multiple select | AUTO |
| `short_answer` | Short answer | AUTO |
| `open_response` / `speaking_prompt` (khi provider hỗ trợ) | Open response / speaking prompt | TEACHER |

Skill (`VOCABULARY`, `GRAMMAR`, `READING`, ...) được lưu trong `settings_json.skill`, vì vậy không làm mất ngữ cảnh khi Lesson trộn nhiều kỹ năng.

## An toàn dữ liệu

- Chỉ câu hỏi **APPROVED** mới được import.
- Chỉ câu hỏi thuộc đúng AI job đang review mới được nhận.
- Teacher chỉ thấy/import vào Lesson do mình sở hữu; Admin chỉ trong center của mình.
- Import idempotent theo `question_version_id`, bấm lại không tạo block trùng.
- Không lưu PDF/prompt nhạy cảm vào log; block giữ reference tới QuestionVersion thay vì nhân bản Question Bank.


## Chế độ trích xuất nguyên văn và grouping

Trong màn hình Question Blueprint, chọn **Giữ nguyên câu hỏi trong PDF (trích xuất nguyên văn)**, đặt tổng số câu và chọn phạm vi **Vocabulary & Grammar**, **Reading**, **Writing** hoặc **Tất cả**. Provider AI sẽ chỉ đọc phạm vi đã chọn; với **Tất cả**, hệ thống duyệt toàn bộ tài liệu theo thứ tự trang/section. Hệ thống không điền quota bằng câu tự nghĩ ra; câu không đủ bằng chứng sẽ bị đưa vào review/được bỏ qua. Chế độ **Sinh câu hỏi mới** vẫn giữ hành vi tạo câu hỏi dựa trên tài liệu như trước.

Mỗi `DocumentChunk` được gắn metadata `activity_type`, `group_key`, `section_title` và `passage_key`. Output AI bắt buộc có `source_group`; khi lưu vào `QuestionVersion.settings_json`, các trường tương ứng là `source_group_key`, `source_activity_type`, `source_passage_key`, `source_passage_text` và `source_preserve_exact`.

Khi import các câu APPROVED vào Lesson, hệ thống giữ thứ tự câu theo `source_question_number` (fallback theo thứ tự chọn). Các câu Reading dùng chung `passage_key` sẽ được gom vào **một block `reading_comprehension`** chứa passage một lần và danh sách câu hỏi con theo thứ tự. Các phần Vocabulary/Grammar/Writing được tạo thành các block/activity riêng, không bị trộn sang Reading. Đây là grouping dữ liệu, không nhân bản câu hỏi trong Question Bank.


> Lưu ý: luồng này dùng lớp text của PDF hiện tại. PDF scan chỉ chứa ảnh sẽ chuyển sang `NEEDS_REVIEW` vì task này không bật OCR; không tự đoán nội dung.
