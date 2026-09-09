# Hello Elementor Child - CI360 ACF Theme

A lightweight, high-performance **Hello Elementor Child Theme** for **CI360 Degrees** with built-in **Custom Post Types (CPT)**, **Taxonomies**, and dynamic **Advanced Custom Fields (ACF)** controls.

---

## 🚀 What's Included

### 1. Dedicated ACF Options Page
- **Hero Settings** (`ci360-hero-settings`): A dedicated menu item in the WordPress Admin sidebar allowing you to update the Hero section without needing to open a page editor.

### 3. Dynamic ACF Hero Section
- **Headlines & Text**: `hero_badge_text`, `hero_title_prefix`, `hero_title_highlight`, `hero_title_suffix`, `hero_description`
- **CTA Buttons**: `hero_btn1_text`, `hero_btn1_url`, `hero_btn2_text`, `hero_btn2_url`
- **Live Metrics Repeater**: `hero_stats_repeater` (`stat_value`, `stat_label`, `stat_color`)
- **Showcase Slides Repeater**: `hero_slides_repeater` (`slide_title`, `slide_tag`, `slide_description`, `slide_image`, `slide_video_url`)
- **Case Study Single Details**: `client_name`, `card_summary`, `impact_metrics`

---

## 📁 Theme Structure

```
hello-elementor-child-ci360-acf/
├── style.css                      # Child theme header & styles
├── functions.php                  # Enqueues, registers shortcodes & CPT/ACF
├── template-home-acf.php          # Page Template: "Home Page (ACF Hero)"
├── template-parts/
│   └── home-hero-acf.php          # Dynamic ACF Hero Section template
├── inc/
│   └── cpt-and-acf.php            # CPTs, Taxonomies, Options Page & Local ACF Groups
└── README.md                      # Documentation
```

---

## 🛠️ How to Use

### 1. Installation
1. In WordPress Admin, go to **Appearance > Themes > Add New > Upload Theme**.
2. Upload and activate **Hello Elementor Child - CI360 ACF**.
3. Ensure the **Advanced Custom Fields (ACF)** plugin is activated.

### 2. Updating Hero Content
- Go to **Hero Settings** in the WordPress admin menu bar, or edit the **Front Page**.
- Fill in your custom headlines, buttons, metrics, or showcase slides.
- Click **Update**.

### 3. Using in Elementor
You can place the sections anywhere on your pages using Elementor's **Shortcode** widget:

- **Dynamic Hero Section**:
  ```text
  [ci360_home_hero]
  ```

- **Dynamic Featured Projects Section**:
  ```text
  [ci360_featured_projects]
  ```
  *Managed directly via CI360 Settings with individual card image links, titles, tags, and bottom insights banner.*

- **Dynamic Foundational Pillars Section (Vision, Mission, Values)**:
  ```text
  [ci360_foundational_pillars]
  ```
  *Presents your Vision, Mission, and Core Values with interactive cards, custom badges, and live bullet points.*

- **Dynamic Real Blog Grid (Include/Exclude Categories & Real Posts)**:
  ```text
  [ci360_blog_grid]
  ```
  *Pulls real published WordPress posts with category filtering, reading time estimates, pagination, and meta box include/exclude category controls.*

