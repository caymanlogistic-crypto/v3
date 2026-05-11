-- STEP 6: add vehicle photo document types to vehicle_files.file_type enum
-- Execute manually in production after backup.

ALTER TABLE vehicle_files
MODIFY COLUMN file_type ENUM(
    'sts',
    'diagnostic_card',
    'truck_photo',
    'trailer_photo',
    'other'
) NOT NULL;