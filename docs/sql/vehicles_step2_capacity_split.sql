-- STEP 2: split vehicles shared capacity/volume into truck + trailer fields
-- Do not drop old fields in this step.

ALTER TABLE vehicles
    ADD COLUMN truck_load_capacity DECIMAL(10,2) NULL AFTER truck_vin,
    ADD COLUMN truck_body_volume DECIMAL(10,2) NULL AFTER truck_load_capacity,
    ADD COLUMN trailer_load_capacity DECIMAL(10,2) NULL AFTER trailer_vin,
    ADD COLUMN trailer_body_volume DECIMAL(10,2) NULL AFTER trailer_load_capacity;

UPDATE vehicles
SET
    truck_load_capacity = load_capacity,
    truck_body_volume = body_volume
WHERE
    truck_load_capacity IS NULL
    AND truck_body_volume IS NULL;
