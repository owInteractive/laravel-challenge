$('#button-filter').on('click', function() {
    let url = urlFilters;
    let name = $('input[name="name"]').val();
    let ownerId = '*';
    let tenantId = '*';
    let conciergeId = '*';
    let brokerId = '*';
    let photographerId = '*';
    let inspectorId = '*';

    if ($('select[name="ownerId"]').val()) {
        ownerId = $('select[name="ownerId"]').val();
    }
    if ($('select[name="tenantId"]').val()) {
        tenantId = $('select[name="tenantId"]').val();
    }
    if ($('select[name="conciergeId"]').val()) {
        conciergeId = $('select[name="conciergeId"]').val();
    }
    if ($('select[name="brokerId"]').val()) {
        brokerId = $('select[name="brokerId"]').val();
    }
    if ($('select[name="photographerId"]').val()) {
        photographerId = $('select[name="photographerId"]').val();
    }
    if ($('select[name="inspectorId"]').val()) {
        inspectorId = $('select[name="inspectorId"]').val();
    }
    if (name || ownerId !== '*' || tenantId !== '*' || conciergeId !== '*' || brokerId !== '*' || photographerId !== '*' || inspectorId !== '*') {
        url += '?filters';
    }
    if (name) {
        url += '&name=' + encodeURIComponent(name);
    }
    if (ownerId !== '*') {
        url += '&ownerId=' + encodeURIComponent(ownerId);
    }
    if (tenantId !== '*') {
        url += '&tenantId=' + encodeURIComponent(tenantId);
    }
    if (conciergeId !== '*') {
        url += '&conciergeId=' + encodeURIComponent(conciergeId);
    }
    if (brokerId !== '*') {
        url += '&brokerId=' + encodeURIComponent(brokerId);
    }
    if (photographerId !== '*') {
        url += '&photographerId=' + encodeURIComponent(photographerId);
    }
    if (inspectorId !== '*') {
        url += '&inspectorId=' + encodeURIComponent(inspectorId);
    }
    location = url;
});
