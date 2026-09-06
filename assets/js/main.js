/**
 * Affinia — Main JavaScript
 *
 * @package Affinia
 * @since 1.0.0
 */

(function () {
  'use strict';

  /**
   * DOM Ready
   */
  document.addEventListener('DOMContentLoaded', function () {
    initToggles();
    initNotificationBadges();
    initChatInput();
    initMobileNav();
    initSmoothScroll();
  });

  /**
   * Toggle switches
   */
  function initToggles() {
    document.querySelectorAll('.toggle').forEach(function (toggle) {
      toggle.addEventListener('click', function () {
        this.classList.toggle('is-active');
        var input = this.querySelector('input[type="checkbox"]');
        if (input) {
          input.checked = !input.checked;
          input.dispatchEvent(new Event('change', { bubbles: true }));
        }
      });
    });
  }

  /**
   * Notification badge counter
   */
  function initNotificationBadges() {
    var unreadItems = document.querySelectorAll('.notification-item.unread');
    var badge = document.querySelector('.bottom-nav-badge');
    if (badge && unreadItems.length > 0) {
      badge.textContent = unreadItems.length;
      badge.style.display = 'flex';
    }
  }

  /**
   * Chat input auto-resize
   */
  function initChatInput() {
    var chatInput = document.querySelector('.chat-input');
    if (!chatInput) return;

    chatInput.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage(this.value);
        this.value = '';
      }
    });

    var sendBtn = document.querySelector('.chat-send-btn');
    if (sendBtn) {
      sendBtn.addEventListener('click', function () {
        sendMessage(chatInput.value);
        chatInput.value = '';
      });
    }
  }

  /**
   * Send message via AJAX
   */
  function sendMessage(message) {
    if (!message.trim()) return;

    // Add message to UI immediately
    var messagesContainer = document.querySelector('.chat-messages');
    if (messagesContainer) {
      var bubble = document.createElement('div');
      bubble.className = 'chat-bubble sent';
      bubble.textContent = message;
      messagesContainer.appendChild(bubble);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Send via AJAX
    if (typeof affiniaAjax !== 'undefined') {
      var formData = new FormData();
      formData.append('action', 'affinia_send_message');
      formData.append('nonce', affiniaAjax.nonce);
      formData.append('message', message);

      fetch(affiniaAjax.ajaxUrl, {
        method: 'POST',
        body: formData,
      })
        .then(function (response) { return response.json(); })
        .then(function (data) {
          if (data.success) {
            // Handle response
          }
        })
        .catch(function (error) {
          console.error('Affinia: Message send error', error);
        });
    }
  }

  /**
   * Mobile bottom navigation active state
   */
  function initMobileNav() {
    var currentPath = window.location.pathname;
    document.querySelectorAll('.bottom-nav-item').forEach(function (item) {
      var href = item.getAttribute('href');
      if (href && currentPath.includes(href.replace(/\/$/, ''))) {
        item.classList.add('is-active');
      }
    });
  }

  /**
   * Smooth scroll for anchors
   */
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
      anchor.addEventListener('click', function (e) {
        var target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });
  }
})();
