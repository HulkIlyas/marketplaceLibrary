<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/translator.php';

$basePath = '../';
$pageTitle = __('createListing.pageTitle') . ' | Marketplace Library';
$pageStylesheet = 'create-listing.css';

require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/topbar.php';
require_once __DIR__ . '/../components/logo-search.php';
require_once __DIR__ . '/../components/navbar.php';
?>
<main class="create-listing-page">
    <section class="listing-hero">
        <div class="container">
            <span class="listing-eyebrow"><?= __('createListing.heroEyebrow') ?></span>
            <h1><?= __('createListing.heroTitle') ?></h1>
            <p><?= __('createListing.heroDescription') ?></p>
        </div>
    </section>

    <div class="container listing-layout">
        <form id="create-listing-form" class="listing-form" novalidate>
            <div id="listing-status" class="listing-status" role="status" aria-live="polite"></div>

            <section class="form-section" aria-labelledby="photos-heading">
                <div class="section-heading">
                    <span class="section-icon" aria-hidden="true"><i class="fa-regular fa-images"></i></span>
                    <div>
                        <h2 id="photos-heading"><?= __('createListing.photosTitle') ?></h2>
                        <p><?= __('createListing.photosSubtitle') ?></p>
                    </div>
                </div>

                <div
                    id="photo-dropzone"
                    class="photo-dropzone"
                    tabindex="0"
                    role="button"
                    aria-controls="book-photos"
                    aria-describedby="photo-help photo-error"
                >
                    <input
                        id="book-photos"
                        class="visually-hidden"
                        type="file"
                        name="photos[]"
                        accept="image/jpeg,image/png,image/webp"
                        multiple
                    />
                    <span class="upload-icon" aria-hidden="true"><i class="fa-solid fa-cloud-arrow-up"></i></span>
                    <strong><?= __('createListing.dragPhotos') ?></strong>
                    <span><?= __('createListing.chooseFiles') ?></span>
                    <small id="photo-help"><?= __('createListing.photoHelp') ?></small>
                </div>
                <p id="photo-error" class="field-error" aria-live="polite"></p>
                <div
                    id="photo-previews"
                    class="photo-previews"
                    aria-label="<?= __('createListing.selectedPhotos') ?>"
                ></div>
            </section>

            <section class="form-section" aria-labelledby="details-heading">
                <div class="section-heading">
                    <span class="section-icon" aria-hidden="true"><i class="fa-solid fa-book-open"></i></span>
                    <div>
                        <h2 id="details-heading"><?= __('createListing.bookInfoTitle') ?></h2>
                        <p><?= __('createListing.bookInfoSubtitle') ?></p>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="listing-field field-wide">
                        <label for="title"><?= __('createListing.bookTitle') ?> <span aria-hidden="true">*</span></label>
                        <input id="title" name="title" type="text" autocomplete="off" required />
                        <p id="title-error" class="field-error"></p>
                    </div>

                    <div class="listing-field">
                        <label for="author"><?= __('createListing.author') ?> <span aria-hidden="true">*</span></label>
                        <input id="author" name="author" type="text" autocomplete="off" required />
                        <p id="author-error" class="field-error"></p>
                    </div>

                    <div class="listing-field">
                        <label for="isbn">
                            <?= __('createListing.isbn') ?>
                            <span class="optional"><?= __('createListing.optional') ?></span>
                        </label>
                        <input id="isbn" name="isbn" type="text" inputmode="numeric" autocomplete="off" />
                        <p id="isbn-error" class="field-error"></p>
                    </div>

                    <div class="listing-field">
                        <label for="category"><?= __('createListing.category') ?> <span aria-hidden="true">*</span></label>
                        <select id="category" name="category" required>
                            <option value=""><?= __('createListing.chooseCategory') ?></option>
                            <option value="Fiction"><?= __('createListing.categories.fiction') ?></option>
                            <option value="Non-fiction"><?= __('createListing.categories.nonFiction') ?></option>
                            <option value="Education"><?= __('createListing.categories.education') ?></option>
                            <option value="Technology"><?= __('createListing.categories.technology') ?></option>
                            <option value="Business"><?= __('createListing.categories.business') ?></option>
                            <option value="Self-development"><?= __('createListing.categories.selfDevelopment') ?></option>
                            <option value="History"><?= __('createListing.categories.history') ?></option>
                            <option value="Manga"><?= __('createListing.categories.manga') ?></option>
                            <option value="Other"><?= __('createListing.categories.other') ?></option>
                        </select>
                        <p id="category-error" class="field-error"></p>
                    </div>

                    <div class="listing-field">
                        <label for="condition"><?= __('createListing.condition') ?> <span aria-hidden="true">*</span></label>
                        <select id="condition" name="condition" required>
                            <option value=""><?= __('createListing.chooseCondition') ?></option>
                            <option value="New"><?= __('createListing.conditions.new') ?></option>
                            <option value="Like New"><?= __('createListing.conditions.likeNew') ?></option>
                            <option value="Very Good"><?= __('createListing.conditions.veryGood') ?></option>
                            <option value="Good"><?= __('createListing.conditions.good') ?></option>
                            <option value="Acceptable"><?= __('createListing.conditions.acceptable') ?></option>
                        </select>
                        <p id="condition-error" class="field-error"></p>
                    </div>
                </div>
            </section>

            <section class="form-section" aria-labelledby="offer-heading">
                <div class="section-heading">
                    <span class="section-icon" aria-hidden="true"><i class="fa-solid fa-tag"></i></span>
                    <div>
                        <h2 id="offer-heading"><?= __('createListing.offerTitle') ?></h2>
                        <p><?= __('createListing.offerSubtitle') ?></p>
                    </div>
                </div>

                <fieldset class="listing-type-group">
                    <legend><?= __('createListing.listingType') ?> <span aria-hidden="true">*</span></legend>
                    <div class="listing-type-options">
                        <label class="listing-type-card">
                            <input type="radio" name="listing_type" value="Sell" required />
                            <span class="radio-mark" aria-hidden="true"></span>
                            <i class="fa-solid fa-money-bill-wave" aria-hidden="true"></i>
                            <strong><?= __('createListing.sell') ?></strong>
                            <small><?= __('createListing.sellHelp') ?></small>
                        </label>
                        <label class="listing-type-card">
                            <input type="radio" name="listing_type" value="Exchange" required />
                            <span class="radio-mark" aria-hidden="true"></span>
                            <i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i>
                            <strong><?= __('createListing.exchange') ?></strong>
                            <small><?= __('createListing.exchangeHelp') ?></small>
                        </label>
                        <label class="listing-type-card">
                            <input type="radio" name="listing_type" value="Sell or Exchange" required />
                            <span class="radio-mark" aria-hidden="true"></span>
                            <i class="fa-solid fa-scale-balanced" aria-hidden="true"></i>
                            <strong><?= __('createListing.sellOrExchange') ?></strong>
                            <small><?= __('createListing.bothHelp') ?></small>
                        </label>
                    </div>
                    <p id="listing_type-error" class="field-error"></p>
                </fieldset>

                <div id="price-field" class="listing-field price-field" hidden>
                    <label for="price"><?= __('createListing.price') ?> <span aria-hidden="true">*</span></label>
                    <div class="price-input">
                        <input id="price" name="price" type="number" min="0.01" step="0.01" inputmode="decimal" />
                        <span><?= __('createListing.currency') ?></span>
                    </div>
                    <p id="price-error" class="field-error"></p>
                </div>
            </section>

            <section class="form-section" aria-labelledby="description-heading">
                <div class="section-heading">
                    <span class="section-icon" aria-hidden="true"><i class="fa-regular fa-pen-to-square"></i></span>
                    <div>
                        <h2 id="description-heading"><?= __('createListing.descriptionTitle') ?></h2>
                        <p><?= __('createListing.descriptionSubtitle') ?></p>
                    </div>
                </div>

                <div class="listing-field">
                    <label for="description"><?= __('createListing.descriptionTitle') ?> <span aria-hidden="true">*</span></label>
                    <textarea
                        id="description"
                        name="description"
                        maxlength="1000"
                        rows="7"
                        placeholder="<?= __('createListing.descriptionPlaceholder') ?>"
                        required
                    ></textarea>
                    <div class="field-meta">
                        <p id="description-error" class="field-error"></p>
                        <span id="description-count">0 / 1000</span>
                    </div>
                </div>

                <div class="listing-field city-field">
                    <label for="city">
                        <?= __('createListing.city') ?>
                        <span class="optional"><?= __('createListing.optional') ?></span>
                    </label>
                    <select id="city" name="city">
                        <option value=""><?= __('createListing.chooseCity') ?></option>
                        <option value="Marrakesh"><?= __('createListing.cities.marrakesh') ?></option>
                        <option value="Casablanca"><?= __('createListing.cities.casablanca') ?></option>
                        <option value="Rabat"><?= __('createListing.cities.rabat') ?></option>
                        <option value="Agadir"><?= __('createListing.cities.agadir') ?></option>
                        <option value="Fes"><?= __('createListing.cities.fes') ?></option>
                        <option value="Tangier"><?= __('createListing.cities.tangier') ?></option>
                        <option value="Other"><?= __('createListing.cities.other') ?></option>
                    </select>
                </div>
            </section>

            <div class="listing-actions">
                <button id="save-draft" class="listing-button button-secondary" type="button">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <?= __('createListing.saveDraft') ?>
                </button>
                <button id="preview-listing" class="listing-button button-outline" type="button">
                    <i class="fa-regular fa-eye"></i>
                    <?= __('createListing.previewListing') ?>
                </button>
                <button class="listing-button button-primary" type="submit">
                    <?= __('createListing.publishListing') ?>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </form>

        <aside class="listing-sidebar" aria-label="<?= __('createListing.sidebarLabel') ?>">
            <div id="listing-preview" class="preview-panel" tabindex="-1">
                <div class="sidebar-heading">
                    <span><?= __('createListing.livePreview') ?></span>
                    <small><?= __('createListing.updatesAsYouType') ?></small>
                </div>
                <article class="preview-card">
                    <div id="preview-image-wrap" class="preview-image-wrap">
                        <div id="preview-placeholder" class="preview-placeholder">
                            <i class="fa-solid fa-book-open" aria-hidden="true"></i>
                            <span><?= __('createListing.coverPlaceholder') ?></span>
                        </div>
                        <img id="preview-image" alt="<?= __('createListing.coverAlt') ?>" hidden />
                        <span id="preview-type" class="preview-type" hidden></span>
                    </div>
                    <div class="preview-content">
                        <span id="preview-condition" class="preview-condition"><?= __('createListing.previewCondition') ?></span>
                        <h2 id="preview-title"><?= __('createListing.previewTitle') ?></h2>
                        <p id="preview-author" class="preview-author"><?= __('createListing.previewAuthor') ?></p>
                        <p id="preview-description" class="preview-description">
                            <?= __('createListing.previewDescription') ?>
                        </p>
                        <strong id="preview-price" class="preview-price"><?= __('createListing.chooseListingType') ?></strong>
                    </div>
                </article>
            </div>

            <section class="publishing-tips">
                <h2>
                    <i class="fa-regular fa-lightbulb" aria-hidden="true"></i>
                    <?= __('createListing.publishingTips') ?>
                </h2>
                <ul>
                    <li><?= __('createListing.tipPhoto') ?></li>
                    <li><?= __('createListing.tipCondition') ?></li>
                    <li><?= __('createListing.tipCheck') ?></li>
                </ul>
            </section>
        </aside>
    </div>
</main>
<script id="create-listing-translations" type="application/json">
<?= json_encode($translations['createListing'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE) ?>
</script>
<script src="../js/create-listing.js"></script>
<?php require_once __DIR__ . '/../components/footer.php'; ?>
