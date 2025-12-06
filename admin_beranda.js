/**
 * ============================================
 * ADMIN BERANDA - JavaScript Functions
 * Handle CRUD operations untuk konten beranda
 * ============================================
 */

let selectedGalleryIds = [];

// Show Alert
function showAlert(message, type = 'success') {
    const alertDiv = $('<div>')
        .addClass(`alert alert-${type}`)
        .text(message)
        .hide()
        .fadeIn();

    $('#alertContainer').html(alertDiv);

    setTimeout(() => {
        alertDiv.fadeOut(() => alertDiv.remove());
    }, 5000);

    // Scroll to top
    $('html, body').animate({ scrollTop: 0 }, 'smooth');
}

// Modal Functions
function closeModal(modalId) {
    $('#' + modalId).fadeOut();
}

function openWhyChooseModal() {
    // Reset form
    $('#whyChooseForm')[0].reset();
    $('#whyChooseAction').val('create_why_choose');
    $('#whyChooseId').val('0');
    $('#whyChooseModalTitle').text('Tambah Item Mengapa Memilih Kami');
    $('#whyChooseStatusGroup').hide();
    $('#whyChooseImagePreview').hide();
    $('#whyChooseModal').fadeIn();
}

function editWhyChoose(item) {
    $('#whyChooseId').val(item.id);
    $('#whyChooseTitle').val(item.title);
    $('#whyChooseDescription').val(item.description);
    $('#whyChooseIcon').val(item.icon_class);
    $('#whyChooseOrder').val(item.display_order);
    $('#whyChooseStatus').val(item.is_active);
    $('#whyChooseAction').val('update_why_choose');
    $('#whyChooseModalTitle').text('Edit Item Mengapa Memilih Kami');
    $('#whyChooseStatusGroup').show();

    if (item.image) {
        $('#whyChooseImagePreview').attr('src', item.image).show();
    }

    $('#whyChooseModal').fadeIn();
}

function deleteWhyChoose(id) {
    if (!confirm('Yakin ingin menghapus item ini?')) return;

    $.ajax({
        url: 'admin_beranda.php',
        type: 'POST',
        data: {
            ajax: 1,
            action: 'delete_why_choose',
            id: id
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                showAlert(response.message, 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showAlert(response.message, 'error');
            }
        },
        error: function () {
            showAlert('Terjadi kesalahan saat menghapus item', 'error');
        }
    });
}

function openBookingStepModal() {
    // Reset form
    $('#bookingStepForm')[0].reset();
    $('#bookingStepAction').val('create_booking_step');
    $('#bookingStepId').val('0');
    $('#bookingStepModalTitle').text('Tambah Langkah Pemesanan');
    $('#bookingStepStatusGroup').hide();
    $('#bookingStepImagePreview').hide();
    $('#bookingStepModal').fadeIn();
}

function editBookingStep(step) {
    $('#bookingStepId').val(step.id);
    $('#bookingStepNumber').val(step.step_number);
    $('#bookingStepTitle').val(step.title);
    $('#bookingStepDescription').val(step.description);
    $('#bookingStepIcon').val(step.icon_class);
    $('#bookingStepStatus').val(step.is_active);
    $('#bookingStepAction').val('update_booking_step');
    $('#bookingStepModalTitle').text('Edit Langkah Pemesanan');
    $('#bookingStepStatusGroup').show();

    if (step.image) {
        $('#bookingStepImagePreview').attr('src', step.image).show();
    }

    $('#bookingStepModal').fadeIn();
}

function deleteBookingStep(id) {
    if (!confirm('Yakin ingin menghapus langkah ini?')) return;

    $.ajax({
        url: 'admin_beranda.php',
        type: 'POST',
        data: {
            ajax: 1,
            action: 'delete_booking_step',
            id: id
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                showAlert(response.message, 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showAlert(response.message, 'error');
            }
        },
        error: function () {
            showAlert('Terjadi kesalahan saat menghapus langkah', 'error');
        }
    });
}

function openGallerySelector() {
    selectedGalleryIds = [];
    $('.gallery-item').removeClass('selected');
    $('#gallerySelectorModal').fadeIn();
}

function selectGalleryImage(element, galleryId) {
    const $element = $(element);

    if ($element.hasClass('selected')) {
        // Deselect
        $element.removeClass('selected');
        selectedGalleryIds = selectedGalleryIds.filter(id => id !== galleryId);
    } else {
        // Select (max 3)
        if (selectedGalleryIds.length >= 3) {
            alert('Maksimal 3 foto yang dapat dipilih');
            return;
        }
        $element.addClass('selected');
        selectedGalleryIds.push(galleryId);
    }
}

function saveGallerySelection() {
    if (selectedGalleryIds.length === 0) {
        alert('Pilih minimal 1 foto');
        return;
    }

    let completed = 0;
    const total = selectedGalleryIds.length;

    selectedGalleryIds.forEach((galleryId, index) => {
        $.ajax({
            url: 'admin_beranda.php',
            type: 'POST',
            data: {
                ajax: 1,
                action: 'add_gallery_to_home',
                gallery_id: galleryId,
                display_order: index + 1
            },
            dataType: 'json',
            success: function (response) {
                completed++;
                if (completed === total) {
                    closeModal('gallerySelectorModal');
                    showAlert('Foto berhasil ditambahkan ke beranda', 'success');
                    setTimeout(() => location.reload(), 1500);
                }
            },
            error: function () {
                completed++;
                if (completed === total) {
                    showAlert('Beberapa foto gagal ditambahkan', 'error');
                }
            }
        });
    });
}

function removeGalleryFromHome(id) {
    if (!confirm('Hapus foto ini dari beranda?')) return;

    $.ajax({
        url: 'admin_beranda.php',
        type: 'POST',
        data: {
            ajax: 1,
            action: 'remove_gallery_from_home',
            id: id
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                showAlert(response.message, 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showAlert(response.message, 'error');
            }
        },
        error: function () {
            showAlert('Terjadi kesalahan', 'error');
        }
    });
}

// Form Submissions
$(document).ready(function () {
    // Hero Section Form
    $('#heroForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: 'admin_beranda.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showAlert(response.message, 'error');
                }
            },
            error: function () {
                showAlert('Terjadi kesalahan saat menyimpan', 'error');
            }
        });
    });

    // Why Choose Us Form
    $('#whyChooseForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: 'admin_beranda.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    closeModal('whyChooseModal');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showAlert(response.message, 'error');
                }
            },
            error: function () {
                showAlert('Terjadi kesalahan saat menyimpan', 'error');
            }
        });
    });

    // Booking Step Form
    $('#bookingStepForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: 'admin_beranda.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    closeModal('bookingStepModal');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showAlert(response.message, 'error');
                }
            },
            error: function () {
                showAlert('Terjadi kesalahan saat menyimpan', 'error');
            }
        });
    });

    // Gallery Section Form
    $('#gallerySectionForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'admin_beranda.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    showAlert(response.message, 'success');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showAlert(response.message, 'error');
                }
            },
            error: function () {
                showAlert('Terjadi kesalahan saat menyimpan', 'error');
            }
        });
    });

    // Close modal on outside click
    $('.modal').on('click', function (e) {
        if (e.target === this) {
            $(this).fadeOut();
        }
    });

    // Image preview
    $('#whyChooseImage').on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#whyChooseImagePreview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });

    $('#bookingStepImage').on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#bookingStepImagePreview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });
});
