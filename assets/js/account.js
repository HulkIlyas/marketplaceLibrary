document.addEventListener('DOMContentLoaded', () => {
    const user = Auth.getUserPayload();

    if (!user) {
        window.location.replace('pages/login.php');
        return;
    }

    const name = user.name || 'Marketplace Library reader';
    const email = user.email || '—';
    const initials =
        name
            .split(/\s+/)
            .filter(Boolean)
            .slice(0, 2)
            .map((part) => part[0].toUpperCase())
            .join('') || 'ML';

    const setText = (id, value) => {
        const element = document.getElementById(id);
        if (element) element.textContent = value;
    };

    setText('account-avatar', initials);
    setText('sidebar-avatar', initials);
    setText('account-name', name);
    setText('sidebar-name', name);
    setText('welcome-name', name.split(/\s+/)[0]);
    setText('account-email', email);
    setText('settings-name', name);
    setText('settings-email', email);
    setText('settings-user-id', user.user_id ?? '—');

    const tabs = [...document.querySelectorAll('[data-tab]')];
    const panels = [...document.querySelectorAll('[data-panel]')];

    const showPanel = (name) => {
        const panelExists = panels.some((panel) => panel.dataset.panel === name);
        const selected = panelExists ? name : 'overview';

        tabs.forEach((tab) => {
            const active = tab.dataset.tab === selected;
            tab.classList.toggle('is-active', active);
            tab.setAttribute('aria-selected', String(active));
        });

        panels.forEach((panel) => {
            const active = panel.dataset.panel === selected;
            panel.classList.toggle('is-active', active);
            panel.hidden = !active;
        });

        history.replaceState(null, '', `#${selected}`);
    };

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => showPanel(tab.dataset.tab));
    });

    document.querySelectorAll('[data-account-tab]').forEach((button) => {
        button.addEventListener('click', () => showPanel(button.dataset.accountTab));
    });

    document.getElementById('logout-button')?.addEventListener('click', () => {
        Auth.logout();
        window.location.href = 'pages/login.php';
    });

    showPanel(window.location.hash.slice(1) || 'overview');
});
