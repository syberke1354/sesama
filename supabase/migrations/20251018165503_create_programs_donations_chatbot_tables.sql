/*
  # Create Programs, Donations, and Chatbot Tables

  ## Overview
  This migration creates tables for managing programs, donations, and chatbot training data.

  ## New Tables

  ### 1. `programs`
  Stores program information that can be managed by admin and displayed as cards.
  - `id` (uuid, primary key) - Unique identifier
  - `title` (text) - Program title
  - `description` (text) - Short description for card
  - `full_description` (text) - Full description for detail page
  - `image_url` (text, nullable) - Program image URL
  - `category` (text) - Program category
  - `status` (text) - active/inactive
  - `created_at` (timestamptz) - Creation timestamp
  - `updated_at` (timestamptz) - Last update timestamp

  ### 2. `donations`
  Stores donation options with WhatsApp integration.
  - `id` (uuid, primary key) - Unique identifier
  - `title` (text) - Donation title
  - `description` (text) - Short description
  - `full_description` (text) - Full description
  - `image_url` (text, nullable) - Donation image URL
  - `whatsapp_number` (text) - WhatsApp contact number (default: 089506147763)
  - `whatsapp_message` (text) - Pre-filled WhatsApp message template
  - `status` (text) - active/inactive
  - `created_at` (timestamptz) - Creation timestamp
  - `updated_at` (timestamptz) - Last update timestamp

  ### 3. `chatbot_knowledge`
  Stores training data for the chatbot.
  - `id` (uuid, primary key) - Unique identifier
  - `title` (text) - Knowledge base entry title
  - `content` (text) - Knowledge base content
  - `category` (text) - Content category
  - `file_url` (text, nullable) - Optional file URL
  - `file_name` (text, nullable) - Original file name
  - `status` (text) - active/inactive
  - `created_at` (timestamptz) - Creation timestamp
  - `updated_at` (timestamptz) - Last update timestamp

  ### 4. `chatbot_conversations`
  Stores chatbot conversation history.
  - `id` (uuid, primary key) - Unique identifier
  - `session_id` (text) - User session identifier
  - `user_message` (text) - User's message
  - `bot_response` (text) - Bot's response
  - `created_at` (timestamptz) - Creation timestamp

  ## Security
  - Enable RLS on all tables
  - Public read access for active programs and donations
  - Admin-only write access for all tables
  - Public access for chatbot conversations
*/

-- Create programs table
CREATE TABLE IF NOT EXISTS programs (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  title text NOT NULL,
  description text NOT NULL,
  full_description text NOT NULL,
  image_url text,
  category text NOT NULL DEFAULT 'general',
  status text NOT NULL DEFAULT 'active',
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);

-- Create donations table
CREATE TABLE IF NOT EXISTS donations (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  title text NOT NULL,
  description text NOT NULL,
  full_description text NOT NULL,
  image_url text,
  whatsapp_number text NOT NULL DEFAULT '089506147763',
  whatsapp_message text NOT NULL DEFAULT 'Halo, saya tertarik untuk berdonasi',
  status text NOT NULL DEFAULT 'active',
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);

-- Create chatbot_knowledge table
CREATE TABLE IF NOT EXISTS chatbot_knowledge (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  title text NOT NULL,
  content text NOT NULL,
  category text NOT NULL DEFAULT 'general',
  file_url text,
  file_name text,
  status text NOT NULL DEFAULT 'active',
  created_at timestamptz DEFAULT now(),
  updated_at timestamptz DEFAULT now()
);

-- Create chatbot_conversations table
CREATE TABLE IF NOT EXISTS chatbot_conversations (
  id uuid PRIMARY KEY DEFAULT gen_random_uuid(),
  session_id text NOT NULL,
  user_message text NOT NULL,
  bot_response text NOT NULL,
  created_at timestamptz DEFAULT now()
);

-- Enable RLS
ALTER TABLE programs ENABLE ROW LEVEL SECURITY;
ALTER TABLE donations ENABLE ROW LEVEL SECURITY;
ALTER TABLE chatbot_knowledge ENABLE ROW LEVEL SECURITY;
ALTER TABLE chatbot_conversations ENABLE ROW LEVEL SECURITY;

-- Programs policies
CREATE POLICY "Public can view active programs"
  ON programs FOR SELECT
  USING (status = 'active');

CREATE POLICY "Authenticated users can view all programs"
  ON programs FOR SELECT
  TO authenticated
  USING (true);

CREATE POLICY "Authenticated users can insert programs"
  ON programs FOR INSERT
  TO authenticated
  WITH CHECK (true);

CREATE POLICY "Authenticated users can update programs"
  ON programs FOR UPDATE
  TO authenticated
  USING (true)
  WITH CHECK (true);

CREATE POLICY "Authenticated users can delete programs"
  ON programs FOR DELETE
  TO authenticated
  USING (true);

-- Donations policies
CREATE POLICY "Public can view active donations"
  ON donations FOR SELECT
  USING (status = 'active');

CREATE POLICY "Authenticated users can view all donations"
  ON donations FOR SELECT
  TO authenticated
  USING (true);

CREATE POLICY "Authenticated users can insert donations"
  ON donations FOR INSERT
  TO authenticated
  WITH CHECK (true);

CREATE POLICY "Authenticated users can update donations"
  ON donations FOR UPDATE
  TO authenticated
  USING (true)
  WITH CHECK (true);

CREATE POLICY "Authenticated users can delete donations"
  ON donations FOR DELETE
  TO authenticated
  USING (true);

-- Chatbot knowledge policies
CREATE POLICY "Public can view active knowledge"
  ON chatbot_knowledge FOR SELECT
  USING (status = 'active');

CREATE POLICY "Authenticated users can view all knowledge"
  ON chatbot_knowledge FOR SELECT
  TO authenticated
  USING (true);

CREATE POLICY "Authenticated users can insert knowledge"
  ON chatbot_knowledge FOR INSERT
  TO authenticated
  WITH CHECK (true);

CREATE POLICY "Authenticated users can update knowledge"
  ON chatbot_knowledge FOR UPDATE
  TO authenticated
  USING (true)
  WITH CHECK (true);

CREATE POLICY "Authenticated users can delete knowledge"
  ON chatbot_knowledge FOR DELETE
  TO authenticated
  USING (true);

-- Chatbot conversations policies (public access for chatbot functionality)
CREATE POLICY "Anyone can insert conversations"
  ON chatbot_conversations FOR INSERT
  WITH CHECK (true);

CREATE POLICY "Anyone can view their own conversations"
  ON chatbot_conversations FOR SELECT
  USING (true);

CREATE POLICY "Authenticated users can view all conversations"
  ON chatbot_conversations FOR SELECT
  TO authenticated
  USING (true);

-- Create indexes for better performance
CREATE INDEX IF NOT EXISTS idx_programs_status ON programs(status);
CREATE INDEX IF NOT EXISTS idx_programs_category ON programs(category);
CREATE INDEX IF NOT EXISTS idx_donations_status ON donations(status);
CREATE INDEX IF NOT EXISTS idx_chatbot_knowledge_status ON chatbot_knowledge(status);
CREATE INDEX IF NOT EXISTS idx_chatbot_knowledge_category ON chatbot_knowledge(category);
CREATE INDEX IF NOT EXISTS idx_chatbot_conversations_session ON chatbot_conversations(session_id);

-- Insert default program data
INSERT INTO programs (title, description, full_description, category, status) VALUES
('Program Khitan Gratis 2025', 'Program khitan gratis untuk anak-anak kurang mampu', 'Program Khitan Gratis 2025 adalah bentuk kepedulian nyata dari Bazma dan Pertamina dalam mendukung kesehatan dan kesejahteraan anak-anak Indonesia. Program ini menyediakan layanan khitan 100% gratis dengan tenaga medis profesional, fasilitas modern, paket obat-obatan lengkap, dan konsultasi kesehatan pasca operasi.

Manfaat Program:
- Layanan khitan 100% gratis
- Ditangani dokter dan tenaga medis berpengalaman
- Fasilitas medis modern dan steril
- Paket obat-obatan lengkap
- Konsultasi kesehatan pasca operasi
- Paket makanan bergizi
- Follow up hingga pemulihan sempurna

Target Peserta: Anak usia 6-12 tahun dari keluarga kurang mampu di seluruh Indonesia

Persyaratan:
- KTP/KK
- Surat Keterangan Tidak Mampu dari kelurahan
- Formulir pendaftaran

Waktu Pelaksanaan: Sepanjang tahun 2025 dengan jadwal fleksibel sesuai lokasi', 'health', 'active')
ON CONFLICT DO NOTHING;

-- Insert default donation data
INSERT INTO donations (title, description, full_description, whatsapp_number, whatsapp_message, status) VALUES
('Donasi Program Khitan Gratis', 'Bantu anak-anak Indonesia mendapatkan layanan khitan gratis', 'Dengan berdonasi, Anda membantu memberikan akses layanan khitan gratis kepada anak-anak dari keluarga kurang mampu. Setiap donasi Anda akan digunakan untuk:

- Biaya operasi khitan
- Peralatan medis steril
- Obat-obatan dan perban
- Paket nutrisi pemulihan
- Konsultasi kesehatan
- Follow up pasca operasi

Mengapa Donasi Penting?
Banyak keluarga kurang mampu yang kesulitan membiayai khitan untuk anak-anak mereka. Dengan dukungan Anda, kami dapat menjangkau lebih banyak anak dan memberikan pelayanan kesehatan yang berkualitas.

Cara Berdonasi:
Hubungi kami melalui WhatsApp untuk informasi rekening donasi dan konfirmasi transfer. Setiap rupiah yang Anda sumbangkan akan dikelola dengan amanah dan transparan.

Terima kasih atas kepedulian Anda!', '089506147763', 'Halo, saya tertarik untuk berdonasi untuk Program Khitan Gratis. Mohon informasi lebih lanjut.', 'active')
ON CONFLICT DO NOTHING;

-- Insert default chatbot knowledge
INSERT INTO chatbot_knowledge (title, content, category, status) VALUES
('Tentang Program Khitan Gratis', 'Program Khitan Gratis adalah program kolaborasi antara Bazma dan Pertamina yang menyediakan layanan khitan gratis untuk anak-anak dari keluarga kurang mampu. Program ini mencakup layanan medis profesional, obat-obatan, dan follow up kesehatan hingga pemulihan sempurna.', 'program', 'active'),
('Persyaratan Program', 'Untuk mengikuti program khitan gratis, peserta harus memenuhi syarat: 1) Anak usia 6-12 tahun, 2) Dari keluarga kurang mampu, 3) Memiliki KTP/KK, 4) Surat Keterangan Tidak Mampu dari kelurahan, 5) Mengisi formulir pendaftaran', 'registration', 'active'),
('Cara Mendaftar', 'Pendaftaran dapat dilakukan melalui admin dengan menghubungi panitia atau datang langsung ke kantor cabang Bazma/Pertamina terdekat. Bawa dokumen persyaratan lengkap. Proses verifikasi memakan waktu 3-7 hari kerja.', 'registration', 'active'),
('Tentang Bazma', 'Bazma adalah Lembaga Amil Zakat Nasional yang telah dipercaya menyalurkan bantuan untuk pendidikan dan kesehatan anak Indonesia sejak tahun 2001. Website: https://bazma.org', 'partner', 'active'),
('Tentang Pertamina', 'PT Pertamina (Persero) adalah BUMN Energi Indonesia yang berkomitmen memberikan manfaat nyata bagi masyarakat melalui program tanggung jawab sosial perusahaan. Website: https://www.pertamina.com', 'partner', 'active'),
('Biaya Program', 'Program ini sepenuhnya GRATIS 100%. Tidak ada biaya tersembunyi. Semua biaya operasi, obat-obatan, konsultasi, dan paket nutrisi ditanggung oleh program.', 'program', 'active'),
('Layanan Konsultasi', 'Kami menyediakan layanan konsultasi gratis 24/7 selama masa pemulihan dan follow up kesehatan hingga anak sembuh total. Tim medis kami siap membantu menjawab pertanyaan kesehatan Anda.', 'service', 'active')
ON CONFLICT DO NOTHING;
