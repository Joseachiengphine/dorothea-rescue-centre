-- ============================================================
-- CORRECTED & COMPLETE SCHEMA FOR DOROTHEA RESCUE CENTRE
-- Based on Admission Form Analysis
-- ============================================================

-- 1️⃣ children
-- Basic info about each child
CREATE TABLE children (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    middle_name VARCHAR(255) NULL,
    surname VARCHAR(255),
    nickname VARCHAR(255) NULL,
    gender ENUM('Male', 'Female') NULL,  -- Form uses "Sex"
    date_of_birth DATE NULL,
    place_of_birth_county VARCHAR(255) NULL,
    sub_county VARCHAR(255) NULL,
    village VARCHAR(255) NULL,
    place_of_birth_known BOOLEAN DEFAULT TRUE,
    ethnicity VARCHAR(255) NULL,
    religion ENUM('Christian', 'Muslim', 'Hindu', 'Other') NULL,
    complexion VARCHAR(255) NULL,
    physical_features TEXT NULL,
    sub_location VARCHAR(255) NULL,  -- ADDED: From "Home of Particulars"
    landmark TEXT NULL,  -- ADDED: Landmark (e.g. school/church/mosque/market)
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 2️⃣ admissions
-- Captures the child's admission record and reasons for entry
CREATE TABLE admissions (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    child_id BIGINT,
    date_of_admission DATE NULL,
    age_at_admission INT NULL,
    admission_order_issued BOOLEAN DEFAULT FALSE,
    committal_order_no VARCHAR(255) NULL,
    date_of_committal DATE NULL,
    ob_number VARCHAR(255) NULL,
    referred_by_name VARCHAR(255) NULL,
    referred_by_title VARCHAR(255) NULL,
    relationship_to_child VARCHAR(255) NULL,
    contact VARCHAR(255) NULL,
    location VARCHAR(255) NULL,
    address_of_current_care_provider TEXT NULL,  -- ADDED: Address separate from name
    other_forms_of_admission VARCHAR(255) NULL,  -- ADDED: "Self-referral", "Abandoned at CCI"
    current_care_type VARCHAR(255) NULL,  -- Could be JSON or separate junction table if multiple
    current_care_address TEXT NULL,
    registration_status VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (child_id) REFERENCES children(id) ON DELETE CASCADE
);

-- 3️⃣ admission_reasons
-- Stores multiple reasons for admission (form allows multiple checkboxes)
CREATE TABLE admission_reasons (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    admission_id BIGINT,
    reason VARCHAR(255),  -- e.g., "School/Education access", "Poverty/family vulnerability", etc.
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (admission_id) REFERENCES admissions(id) ON DELETE CASCADE
);

-- 4️⃣ previous_placements
-- Keeps track of prior care placements
CREATE TABLE previous_placements (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    child_id BIGINT,
    placement_type VARCHAR(255),  -- "CCI", "Kinship", "Foster", "Kafaalah", "Guardianship", "Temporary", "Other"
    `from` DATE NULL,
    `to` DATE NULL,
    notes TEXT NULL,  -- For additional details like "various CCIs" mentioned in form
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (child_id) REFERENCES children(id) ON DELETE CASCADE
);

-- 5️⃣ education_backgrounds
-- Stores school history and current schooling details
CREATE TABLE education_backgrounds (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    child_id BIGINT,
    previously_attended BOOLEAN DEFAULT FALSE,
    previous_school_name VARCHAR(255) NULL,
    previous_school_location VARCHAR(255) NULL,
    previous_school_type ENUM('Public', 'Private') NULL,  -- ADDED
    previous_school_day_boarding ENUM('Day', 'Boarding') NULL,  -- ADDED
    currently_attending BOOLEAN DEFAULT FALSE,
    current_school_name VARCHAR(255) NULL,
    current_school_location VARCHAR(255) NULL,
    current_school_type ENUM('Public', 'Private') NULL,  -- ADDED
    current_school_day_boarding ENUM('Day', 'Boarding') NULL,  -- ADDED
    education_level VARCHAR(255) NULL,  -- General level
    current_education_level_detail VARCHAR(255) NULL,  -- ADDED: "ECD/Grade/Form/Vocational/Tertiary"
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (child_id) REFERENCES children(id) ON DELETE CASCADE
);

-- 6️⃣ parents
-- Each child may have two parents (Mother and Father)
CREATE TABLE parents (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    child_id BIGINT,
    type ENUM('Mother', 'Father'),
    name VARCHAR(255) NULL,
    other_names VARCHAR(255) NULL,
    last_known_location VARCHAR(255) NULL,
    contact VARCHAR(255) NULL,
    occupation_or_education VARCHAR(255) NULL,  -- ADDED: "Occupation/Education/Employment"
    status ENUM('Alive', 'Deceased', 'Not known') NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (child_id) REFERENCES children(id) ON DELETE CASCADE
);

-- 7️⃣ siblings
-- For recording sibling details
-- Note: Form has separate sections for siblings living with child vs admitted elsewhere
CREATE TABLE siblings (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    child_id BIGINT,
    name VARCHAR(255) NULL,
    last_known_location VARCHAR(255) NULL,
    occupation_or_education VARCHAR(255) NULL,
    age INT NULL,
    contact VARCHAR(255) NULL,
    living_with_child BOOLEAN DEFAULT FALSE,  -- "Are there other siblings living with the child now"
    admitted_elsewhere BOOLEAN DEFAULT FALSE,  -- "Are there other siblings admitted into care elsewhere"
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (child_id) REFERENCES children(id) ON DELETE CASCADE
);

-- 8️⃣ rescue_details
-- Where and when the child was found or rescued
CREATE TABLE rescue_details (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    child_id BIGINT,
    found_by VARCHAR(255) NULL,  -- "Name of institution/Person that found the child"
    found_location TEXT NULL,  -- "Where was the child found?"
    date_found DATE NULL,  -- "When was the child found?"
    case_history TEXT NULL,  -- "Child Case History" section
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (child_id) REFERENCES children(id) ON DELETE CASCADE
);

-- 9️⃣ health_records
-- Health and hospitalization history
CREATE TABLE health_records (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    child_id BIGINT,
    hospitalized BOOLEAN DEFAULT FALSE,
    illness VARCHAR(255) NULL,  -- "If yes, what were you suffering from?"
    health_notes TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (child_id) REFERENCES children(id) ON DELETE CASCADE
);

-- 🔟 signatures
-- Captures signatures and sign-off dates
CREATE TABLE signatures (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    child_id BIGINT,
    role ENUM('Child', 'Social Worker', 'Director') NOT NULL,  -- UPDATED: Specific roles from form
    name VARCHAR(255) NULL,
    signed_date DATE NULL,
    signature_file VARCHAR(255) NULL,  -- For storing signature image/file
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (child_id) REFERENCES children(id) ON DELETE CASCADE
);

-- ============================================================
-- OPTIONAL: If "Home of Particulars" is different from "Place of Birth"
-- Uncomment this table if you need to track separate addresses
-- ============================================================
-- CREATE TABLE home_of_particulars (
--     id BIGINT AUTO_INCREMENT PRIMARY KEY,
--     child_id BIGINT,
--     county VARCHAR(255) NULL,
--     sub_county VARCHAR(255) NULL,
--     location VARCHAR(255) NULL,
--     sub_location VARCHAR(255) NULL,
--     village_or_estate VARCHAR(255) NULL,
--     landmark TEXT NULL,
--     created_at TIMESTAMP NULL,
--     updated_at TIMESTAMP NULL,
--     FOREIGN KEY (child_id) REFERENCES children(id) ON DELETE CASCADE
-- );

-- ============================================================
-- OPTIONAL: If current_care_type can have multiple selections
-- Uncomment if you need to support multiple care types
-- ============================================================
-- CREATE TABLE admission_care_types (
--     id BIGINT AUTO_INCREMENT PRIMARY KEY,
--     admission_id BIGINT,
--     care_type ENUM(
--         'Kinship care',
--         'Foster care',
--         'Temporary shelter',
--         'CCI',
--         'SCI',
--         'Supported child-Headed household',
--         'Supported Independent Living',
--         'Kafaalah',
--         'Guardianship',
--         'Other'
--     ),
--     created_at TIMESTAMP NULL,
--     updated_at TIMESTAMP NULL,
--     FOREIGN KEY (admission_id) REFERENCES admissions(id) ON DELETE CASCADE
-- );
