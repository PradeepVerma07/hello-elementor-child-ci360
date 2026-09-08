# Hello Elementor Child - CI360 ACF Theme

A lightweight, high-performance **Hello Elementor Child Theme** for **CI360 Degrees** with dynamic **Advanced Custom Fields (ACF)** support for the Home Hero section.

---

## 🚀 Features

- **100% Dynamic ACF Controls**: Full WordPress admin control for headlines, badges, description, CTA buttons, metrics, and right showcase slider.
- **Built-in Fallbacks**: Gracefully falls back to default CI360 styles and content if ACF is inactive or fields are blank.
- **Video & Image Slider**: Auto-sliding right showcase card with direct MP4 video support and slide counter.
- **Electric Cyan & Blue Aesthetic**: Sleek glassmorphic dark theme (`#020617`), zero pink accents.
- **Elementor Shortcode Ready**: Use `[ci360_home_hero]` anywhere in Elementor with instant preview.

---

## 📁 Theme Structure

```
hello-elementor-child-ci360-acf/
├── style.css                      # Child theme header & styles
├── functions.php                  # Enqueues, registers shortcodes & ACF fields
├── template-home-acf.php          # Page Template: "Home Page (ACF Hero)"
├── template-parts/
│   └── home-hero-acf.php          # Dynamic ACF Hero Section template
├── inc/
│   └── acf-fields.php             # Auto-registers tabbed ACF Field Group in WP Admin
└── README.md                      # Documentation
```

---

## 🛠️ How to Use

### 1. Installation
1. Download or clone this repository.
2. In WordPress Admin, go to **Appearance > Themes > Add New > Upload Theme**.
3. Upload the theme folder/zip and activate it.

### 2. Using in Elementor
1. Open any page in Elementor.
2. Drag a **Shortcode** widget into the section.
3. Enter:
   ```
   [ci360_home_hero]
   ```

### 3. Using as a Page Template
When editing the Home Page, select Template: **Home Page (ACF Hero)** under Page Attributes.

---

## ⚙️ ACF Fields Reference

When editing the Front Page in WordPress Admin, the **"Home Page: Hero Section Settings"** metabox provides:

| Tab | Fields | Description |
| :--- | :--- | :--- |
| **Headlines & Text** | `hero_badge_text`, `hero_title_prefix`, `hero_title_highlight`, `hero_title_suffix`, `hero_description` | Badge text, 3-part headline with gradient words, and intro description |
| **CTA Buttons** | `hero_btn1_text`, `hero_btn1_url`, `hero_btn2_text`, `hero_btn2_url` | Primary & Secondary button labels and links |
| **Key Metrics** | `hero_stats_repeater` (`stat_value`, `stat_label`, `stat_color`) | 4 live metric stat cards |
| **Showcase Slider** | `hero_slides_repeater` (`slide_title`, `slide_tag`, `slide_description`, `slide_image`, `slide_video_url`) | Right showcase cards with optional MP4 video |

---

## 📄 License
GPL v2 or later.
