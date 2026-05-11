-- STEP 6B: add trailer document types to vehicle_files.file_type enum
-- Apply manually after backup.

ALTER TABLE vehicle_files
MODIFY COLUMN file_type ENUM(
  'sts',
  'diagnostic_card',
  'trailer_sts',
  'trailer_diagnostic_card',
  'truck_photo',
  'trailer_photo',
  'other'
) NOT NULL;