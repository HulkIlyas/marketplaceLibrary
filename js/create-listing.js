document.addEventListener('DOMContentLoaded', () => {
    if (typeof Auth === 'undefined' || !Auth.isAuthenticated()) {
        window.location.replace('login.php');
        return;
    }

    const user = Auth.getUserPayload();
    const translationElement = document.getElementById('create-listing-translations');
    let translations = {};

    try {
        translations = JSON.parse(translationElement?.textContent || '{}');
    } catch (error) {
        translations = {};
    }

    function translate(key, fallback, replacements = []) {
        let message = translations[key] || fallback;
        replacements.forEach((replacement) => {
            message = message.replace('%s', replacement);
        });
        return message;
    }

    const form = document.getElementById('create-listing-form');
    if (!form) {
        return;
    }

    const MAX_PHOTOS = 5;
    const MAX_FILE_SIZE = 5 * 1024 * 1024;
    const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp'];
    const userKey = user?.id || user?.user_id || user?.sub || 'authenticated-user';
    const DRAFT_KEY = `marketplace_listing_draft_${userKey}`;
    const photoInput = document.getElementById('book-photos');
    const dropzone = document.getElementById('photo-dropzone');
    const photoPreviews = document.getElementById('photo-previews');
    const photoError = document.getElementById('photo-error');
    const priceField = document.getElementById('price-field');
    const priceInput = document.getElementById('price');
    const description = document.getElementById('description');
    const descriptionCount = document.getElementById('description-count');
    const status = document.getElementById('listing-status');
    const previewPanel = document.getElementById('listing-preview');
    let selectedPhotos = [];

    const preview = {
        image: document.getElementById('preview-image'),
        placeholder: document.getElementById('preview-placeholder'),
        title: document.getElementById('preview-title'),
        author: document.getElementById('preview-author'),
        condition: document.getElementById('preview-condition'),
        type: document.getElementById('preview-type'),
        price: document.getElementById('preview-price'),
        description: document.getElementById('preview-description')
    };

    function showStatus(message, type = 'info') {
        status.textContent = message;
        status.className = `listing-status is-visible is-${type}`;
    }

    function clearStatus() {
        status.textContent = '';
        status.className = 'listing-status';
    }

    function photoSignature(file) {
        return `${file.name}-${file.size}-${file.lastModified}`;
    }

    function setPhotoError(message = '') {
        photoError.textContent = message;
        dropzone.classList.toggle('is-invalid', Boolean(message));
    }

    function addPhotos(fileList) {
        setPhotoError();
        const incomingFiles = Array.from(fileList);
        const validFiles = [];
        const errors = [];

        incomingFiles.forEach((file) => {
            if (!ALLOWED_TYPES.includes(file.type)) {
                errors.push(translate(
                    'invalidFileType',
                    '%s: use a JPG, PNG, or WebP image.',
                    [file.name]
                ));
                return;
            }

            if (file.size > MAX_FILE_SIZE) {
                errors.push(translate(
                    'fileTooLarge',
                    '%s: the file is larger than 5 MB.',
                    [file.name]
                ));
                return;
            }

            const duplicate = [...selectedPhotos, ...validFiles].some(
                (photo) => photoSignature(photo.file || photo) === photoSignature(file)
            );
            if (!duplicate) {
                validFiles.push(file);
            }
        });

        const availableSlots = MAX_PHOTOS - selectedPhotos.length;
        if (validFiles.length > availableSlots) {
            errors.push(translate('tooManyPhotos', `You can add up to ${MAX_PHOTOS} photos.`));
        }

        validFiles.slice(0, availableSlots).forEach((file) => {
            selectedPhotos.push({
                file,
                url: URL.createObjectURL(file)
            });
        });

        photoInput.value = '';
        renderPhotos();
        if (errors.length) {
            setPhotoError(errors.join(' '));
        }
    }

    function renderPhotos() {
        photoPreviews.replaceChildren();

        selectedPhotos.forEach((photo, index) => {
            const item = document.createElement('div');
            item.className = 'photo-preview';

            const image = document.createElement('img');
            image.src = photo.url;
            image.alt = index === 0
                ? translate('selectedCoverPhoto', 'Selected cover photo')
                : translate('selectedBookPhoto', 'Selected book photo %s', [String(index + 1)]);

            const removeButton = document.createElement('button');
            removeButton.className = 'remove-photo';
            removeButton.type = 'button';
            removeButton.dataset.photoIndex = String(index);
            removeButton.textContent = translate('remove', 'Remove');
            removeButton.setAttribute(
                'aria-label',
                translate('removePhoto', 'Remove photo %s', [String(index + 1)])
            );

            item.append(image);
            if (index === 0) {
                const coverLabel = document.createElement('span');
                coverLabel.className = 'cover-label';
                coverLabel.textContent = translate('cover', 'Cover');
                item.append(coverLabel);
            }
            item.append(removeButton);
            photoPreviews.append(item);
        });

        updatePreview();
    }

    function removePhoto(index) {
        const removed = selectedPhotos.splice(index, 1)[0];
        if (removed) {
            URL.revokeObjectURL(removed.url);
        }
        setPhotoError();
        renderPhotos();
    }

    function getListingType() {
        return form.querySelector('input[name="listing_type"]:checked')?.value || '';
    }

    function updatePriceVisibility() {
        const listingType = getListingType();
        const needsPrice = listingType === 'Sell' || listingType === 'Sell or Exchange';
        priceField.hidden = !needsPrice;
        priceInput.required = needsPrice;
        priceInput.disabled = !needsPrice;

        if (!needsPrice) {
            priceInput.value = '';
            clearFieldError('price');
        }
    }

    function updatePreview() {
        const title = form.elements.title.value.trim();
        const author = form.elements.author.value.trim();
        const condition = form.elements.condition.value;
        const listingType = getListingType();
        const price = priceInput.value;
        const descriptionValue = description.value.trim();

        preview.title.textContent = title || translate('previewTitle', 'Your book title');
        preview.author.textContent = author || translate('previewAuthor', 'Author name');
        preview.condition.textContent = condition
            ? form.elements.condition.selectedOptions[0].textContent
            : translate('previewCondition', 'Condition');
        preview.description.textContent = descriptionValue ||
            translate(
                'previewDescription',
                'Your description will appear here so readers can learn more about the book.'
            );
        const listingTypeLabels = {
            Sell: translate('sell', 'Sell'),
            Exchange: translate('exchange', 'Exchange'),
            'Sell or Exchange': translate('sellOrExchange', 'Sell or Exchange')
        };
        preview.type.textContent = listingTypeLabels[listingType] || '';
        preview.type.hidden = !listingType;

        if (listingType === 'Exchange') {
            preview.price.textContent = translate('availableForExchange', 'Available for exchange');
        } else if (listingType && price !== '') {
            preview.price.textContent = `${Number(price).toLocaleString(document.documentElement.lang, {
                maximumFractionDigits: 2
            })} ${translate('currency', 'MAD')}`;
        } else if (listingType) {
            preview.price.textContent = translate('priceInMad', 'Price in MAD');
        } else {
            preview.price.textContent = translate('chooseListingType', 'Choose a listing type');
        }

        if (selectedPhotos.length) {
            preview.image.src = selectedPhotos[0].url;
            preview.image.hidden = false;
            preview.placeholder.hidden = true;
        } else {
            preview.image.removeAttribute('src');
            preview.image.hidden = true;
            preview.placeholder.hidden = false;
        }

        descriptionCount.textContent = `${description.value.length} / 1000`;
    }

    function setFieldError(fieldName, message) {
        const field = form.elements[fieldName];
        const error = document.getElementById(`${fieldName}-error`);
        if (error) {
            error.textContent = message;
        }

        if (fieldName === 'listing_type') {
            form.querySelector('.listing-type-group')?.classList.toggle('is-invalid', Boolean(message));
            return;
        }

        field?.classList.toggle('is-invalid', Boolean(message));
        field?.setAttribute('aria-invalid', String(Boolean(message)));
        if (error && field) {
            field.setAttribute('aria-describedby', error.id);
        }
    }

    function clearFieldError(fieldName) {
        setFieldError(fieldName, '');
    }

    function validateForm() {
        let isValid = true;
        const requiredFields = [
            ['title', translate('titleRequired', 'Enter the book title.')],
            ['author', translate('authorRequired', 'Enter the author name.')],
            ['category', translate('categoryRequired', 'Choose a category.')],
            ['condition', translate('conditionRequired', 'Choose the book condition.')],
            ['description', translate('descriptionRequired', 'Add a description of the book.')]
        ];

        const hasPhoto = selectedPhotos.length > 0;
        setPhotoError(hasPhoto ? '' : translate('photoRequired', 'Add at least one photo of your book.'));
        if (!hasPhoto) {
            isValid = false;
        }

        requiredFields.forEach(([name, message]) => {
            const value = form.elements[name].value.trim();
            setFieldError(name, value ? '' : message);
            if (!value) {
                isValid = false;
            }
        });

        const listingType = getListingType();
        setFieldError(
            'listing_type',
            listingType ? '' : translate('listingTypeRequired', 'Choose a listing type.')
        );
        if (!listingType) {
            isValid = false;
        }

        const needsPrice = listingType === 'Sell' || listingType === 'Sell or Exchange';
        const validPrice = !needsPrice || (priceInput.value !== '' && Number(priceInput.value) > 0);
        setFieldError(
            'price',
            validPrice ? '' : translate('priceRequired', 'Enter a price greater than 0 MAD.')
        );
        if (!validPrice) {
            isValid = false;
        }

        return isValid;
    }

    function draftData() {
        return {
            title: form.elements.title.value,
            author: form.elements.author.value,
            isbn: form.elements.isbn.value,
            category: form.elements.category.value,
            condition: form.elements.condition.value,
            listing_type: getListingType(),
            price: priceInput.value,
            description: description.value,
            city: form.elements.city.value
        };
    }

    function saveDraft() {
        try {
            localStorage.setItem(DRAFT_KEY, JSON.stringify(draftData()));
            showStatus(translate(
                'draftSaved',
                'Draft saved on this device. Photos are not stored and will need to be selected again.'
            ), 'success');
        } catch (error) {
            showStatus(translate('draftFailed', 'The draft could not be saved in this browser.'), 'error');
        }
    }

    function restoreDraft() {
        let draft;
        try {
            draft = JSON.parse(localStorage.getItem(DRAFT_KEY));
        } catch (error) {
            return;
        }

        if (!draft || typeof draft !== 'object') {
            return;
        }

        ['title', 'author', 'isbn', 'category', 'condition', 'price', 'description', 'city'].forEach((name) => {
            if (typeof draft[name] === 'string' && form.elements[name]) {
                form.elements[name].value = draft[name];
            }
        });

        if (draft.listing_type) {
            const typeInput = Array.from(form.elements.listing_type).find(
                (input) => input.value === draft.listing_type
            );
            if (typeInput) {
                typeInput.checked = true;
            }
        }

        updatePriceVisibility();
        updatePreview();
        showStatus(translate(
            'draftRestored',
            'Your saved draft was restored. Photos are not included in saved drafts.'
        ), 'info');
    }

    dropzone.addEventListener('click', () => photoInput.click());
    dropzone.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault();
            photoInput.click();
        }
    });

    ['dragenter', 'dragover'].forEach((eventName) => {
        dropzone.addEventListener(eventName, (event) => {
            event.preventDefault();
            dropzone.classList.add('is-dragging');
        });
    });

    ['dragleave', 'drop'].forEach((eventName) => {
        dropzone.addEventListener(eventName, (event) => {
            event.preventDefault();
            dropzone.classList.remove('is-dragging');
        });
    });

    dropzone.addEventListener('drop', (event) => addPhotos(event.dataTransfer.files));
    photoInput.addEventListener('change', () => addPhotos(photoInput.files));
    photoPreviews.addEventListener('click', (event) => {
        const button = event.target.closest('[data-photo-index]');
        if (button) {
            removePhoto(Number(button.dataset.photoIndex));
        }
    });

    form.addEventListener('input', (event) => {
        clearStatus();
        if (event.target.name && event.target.name !== 'photos[]') {
            clearFieldError(event.target.name);
        }
        updatePreview();
    });

    form.addEventListener('change', (event) => {
        if (event.target.name === 'listing_type') {
            updatePriceVisibility();
        }
        updatePreview();
    });

    document.getElementById('save-draft').addEventListener('click', saveDraft);
    document.getElementById('preview-listing').addEventListener('click', () => {
        updatePreview();
        previewPanel.scrollIntoView({ behavior: 'smooth', block: 'center' });
        window.setTimeout(() => previewPanel.focus({ preventScroll: true }), 400);
        showStatus(translate(
            'previewReady',
            'The live preview is ready. This is a local preview and has not been published.'
        ), 'info');
    });

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        clearStatus();

        if (!validateForm()) {
            showStatus(translate(
                'correctFields',
                'Please correct the highlighted fields before publishing.'
            ), 'error');
            if (selectedPhotos.length === 0) {
                dropzone.scrollIntoView({ behavior: 'smooth', block: 'center' });
                dropzone.focus({ preventScroll: true });
            } else {
                form.querySelector('.is-invalid')?.focus();
            }
            return;
        }

        showStatus(
            translate(
                'publishUnavailable',
                'Listing publishing will be available when the marketplace listing API is connected. Nothing has been uploaded or published.'
            ),
            'info'
        );
        status.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });

    window.addEventListener('beforeunload', () => {
        selectedPhotos.forEach((photo) => URL.revokeObjectURL(photo.url));
    });

    restoreDraft();
    updatePriceVisibility();
    updatePreview();
});
