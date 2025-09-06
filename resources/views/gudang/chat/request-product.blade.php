@extends('layouts.appGudang')

@section('title', 'Request Produk - ' . $chatRoom->nama_room)

@section('content')
<style>
/* Form Request Produk - Dark Mode Compatible */

/* Container styles that adapt to theme */
.request-product-container {
    height: calc(100vh - 110px); /* Slightly reduced height */
    overflow: hidden;
    background: var(--bs-body-bg, white);
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    margin: 10px 0; /* Reduced margin */
}

/* Dark mode container */
[data-bs-theme="dark"] .request-product-container,
body.dark-mode .request-product-container {
    background: #1a202c !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3) !important;
}

/* Form inputs - Light mode (white background) */
.request-product-container .form-control,
.request-product-container .form-select,
.request-product-container input,
.request-product-container textarea,
.request-product-container select {
    background-color: #ffffff !important;
    color: #212529 !important;
    border-color: #dee2e6 !important;
    transition: all 0.2s ease;
}

.request-product-container .form-control:focus,
.request-product-container .form-select:focus,
.request-product-container input:focus,
.request-product-container textarea:focus,
.request-product-container select:focus {
    background-color: #ffffff !important;
    color: #212529 !important;
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
}

/* Dark mode form inputs - Dark background with light text */
[data-bs-theme="dark"] .request-product-container .form-control,
[data-bs-theme="dark"] .request-product-container .form-select,
[data-bs-theme="dark"] .request-product-container input,
[data-bs-theme="dark"] .request-product-container textarea,
[data-bs-theme="dark"] .request-product-container select,
body.dark-mode .request-product-container .form-control,
body.dark-mode .request-product-container .form-select,
body.dark-mode .request-product-container input,
body.dark-mode .request-product-container textarea,
body.dark-mode .request-product-container select {
    background-color: #2d3748 !important;
    color: #ffffff !important;
    border-color: #4a5568 !important;
}

[data-bs-theme="dark"] .request-product-container .form-control:focus,
[data-bs-theme="dark"] .request-product-container .form-select:focus,
[data-bs-theme="dark"] .request-product-container input:focus,
[data-bs-theme="dark"] .request-product-container textarea:focus,
[data-bs-theme="dark"] .request-product-container select:focus,
body.dark-mode .request-product-container .form-control:focus,
body.dark-mode .request-product-container .form-select:focus,
body.dark-mode .request-product-container input:focus,
body.dark-mode .request-product-container textarea:focus,
body.dark-mode .request-product-container select:focus {
    background-color: #2d3748 !important;
    color: #ffffff !important;
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
}

/* Placeholder colors */
.request-product-container .form-control::placeholder,
.request-product-container .form-select::placeholder,
.request-product-container input::placeholder,
.request-product-container textarea::placeholder {
    color: #6c757d !important;
    opacity: 1 !important;
}

[data-bs-theme="dark"] .request-product-container .form-control::placeholder,
[data-bs-theme="dark"] .request-product-container .form-select::placeholder,
[data-bs-theme="dark"] .request-product-container input::placeholder,
[data-bs-theme="dark"] .request-product-container textarea::placeholder,
body.dark-mode .request-product-container .form-control::placeholder,
body.dark-mode .request-product-container .form-select::placeholder,
body.dark-mode .request-product-container input::placeholder,
body.dark-mode .request-product-container textarea::placeholder {
    color: #a0aec0 !important;
    opacity: 1 !important;
}

/* Header styles */
.request-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 15px 20px;
    border-radius: 12px 12px 0 0;
    flex-shrink: 0;
}

.request-header h5 {
    font-size: 1.3rem;
    font-weight: 700;
    margin: 0;
}

/* Modern Back Button */
.btn-back-chat {
    background: rgba(255, 255, 255, 0.2) !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    color: white !important;
    padding: 8px 16px !important;
    border-radius: 20px !important;
    font-size: 0.85rem !important;
    font-weight: 500 !important;
    transition: all 0.3s ease !important;
    backdrop-filter: blur(10px);
    text-decoration: none !important;
}

.btn-back-chat:hover {
    background: rgba(255, 255, 255, 0.3) !important;
    border-color: rgba(255, 255, 255, 0.5) !important;
    color: white !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.btn-back-chat:focus,
.btn-back-chat:active {
    background: rgba(255, 255, 255, 0.25) !important;
    border-color: rgba(255, 255, 255, 0.4) !important;
    color: white !important;
    box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
}

/* Content layout */
.request-content {
    display: flex;
    height: calc(100% - 70px);
    overflow: hidden;
}

.form-section {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    scrollbar-width: thin;
    background: var(--bs-body-bg, white);
}

[data-bs-theme="dark"] .form-section,
body.dark-mode .form-section {
    background: #1a202c !important;
}

/* Sidebar section */
.sidebar-section {
    width: 300px; /* Fixed width */
    background: var(--bs-gray-50, #f8fafc);
    border-left: 1px solid var(--bs-border-color, #e2e8f0);
    padding: 15px; /* Reduced padding */
    overflow: hidden; /* No scroll */
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    gap: 8px; /* Space between sections */
}

[data-bs-theme="dark"] .sidebar-section,
body.dark-mode .sidebar-section {
    background: #2d3748 !important;
    border-color: #4a5568 !important;
}

/* Card styles */
.compact-card {
    background: var(--bs-body-bg, white);
    border: 1px solid var(--bs-border-color, #e2e8f0);
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

[data-bs-theme="dark"] .compact-card,
body.dark-mode .compact-card {
    background: #2d3748 !important;
    border-color: #4a5568 !important;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2) !important;
}

/* Supplier info */
.supplier-info {
    background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%) !important;
    border: 1px solid #bae6fd !important;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 15px;
}

[data-bs-theme="dark"] .supplier-info,
body.dark-mode .supplier-info {
    background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%) !important;
    border-color: #3b82f6 !important;
    color: #e2e8f0 !important;
}

/* Form layout */
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 15px;
}

.form-group-compact {
    margin-bottom: 12px;
}

.form-group-compact label {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--bs-body-color, #374151);
    margin-bottom: 4px;
    display: block;
}

[data-bs-theme="dark"] .form-group-compact label,
body.dark-mode .form-group-compact label {
    color: #e2e8f0 !important;
}

.request-header {
    background: linear-gradient(135deg, #f26b37 0%, #e55827 100%);
    color: white;
    padding: 15px 20px;
    border-radius: 12px 12px 0 0;
    flex-shrink: 0;
}

.request-header h5 {
    font-size: 1.3rem;
    font-weight: 700;
    margin: 0;
}

.request-content {
    display: flex;
    height: calc(100% - 70px);
    overflow: hidden;
}

.form-section {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    scrollbar-width: thin;
    background: var(--bs-body-bg, white);
}

.sidebar-section {
    width: 300px;
    background: var(--bs-gray-100, #f8fafc);
    border-left: 1px solid var(--bs-border-color, #e2e8f0);
    padding: 15px;
    overflow: hidden; /* No scroll */
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    height: 100%;
}

/* Compact sidebar sections */
.sidebar-section > div {
    margin-bottom: 10px;
}

.sidebar-section > div:last-child {
    margin-bottom: 0;
}

/* Tips section - optimized size */
.tips-section {
    background: var(--bs-success-bg-subtle, #f0fdfa);
    border: 1px solid var(--bs-success-border-subtle, #a7f3d0);
    border-radius: 8px;
    padding: 10px 12px 12px 12px; /* Reduced top padding */
    flex: 0 0 auto; /* Fixed size */
    height: 170px; /* Fixed height instead of max-height */
    overflow: hidden; /* Hide overflow completely - no scroll */
    display: flex;
    flex-direction: column;
}

[data-bs-theme="dark"] .tips-section,
body.dark-mode .tips-section {
    background: #1a2f23 !important;
    border-color: #2d5a41 !important;
}

.tips-section h6 {
    color: var(--bs-success-text, #065f46);
    font-size: 0.8rem; /* Slightly smaller */
    margin-bottom: 8px; /* Reduced margin */
    font-weight: 600;
    flex-shrink: 0; /* Don't shrink the header */
}

[data-bs-theme="dark"] .tips-section h6,
body.dark-mode .tips-section h6 {
    color: #86efac !important;
}

.tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
    flex: 1; /* Take remaining space */
    overflow: hidden; /* Hide any overflow */
}

.tips-list li {
    font-size: 0.7rem; /* Smaller font */
    color: var(--bs-success-text, #047857);
    margin-bottom: 3px; /* Reduced spacing */
    position: relative;
    padding-left: 15px;
    line-height: 1.2; /* Tighter line height */
    padding-bottom: 1px; /* Minimal bottom padding */
}

[data-bs-theme="dark"] .tips-list li,
body.dark-mode .tips-list li {
    color: #bbf7d0 !important;
}

.tips-list li:before {
    content: '✓';
    position: absolute;
    left: 0;
    color: var(--bs-success, #10b981);
    font-weight: bold;
    font-size: 0.7rem;
}

[data-bs-theme="dark"] .tips-list li:before,
body.dark-mode .tips-list li:before {
    color: #86efac !important;
}

/* Example section - compact */
.example-section {
    background: var(--bs-warning-bg-subtle, #fef3c7);
    border: 1px solid var(--bs-warning-border-subtle, #fbbf24);
    border-radius: 8px;
    padding: 10px 12px; /* Reduced padding */
    flex: 0 0 auto;
    height: 150px; /* Fixed height */
    overflow: hidden; /* No scroll */
    margin: 10px 0;
    display: flex;
    flex-direction: column;
}

[data-bs-theme="dark"] .example-section,
body.dark-mode .example-section {
    background: #2d1b05 !important;
    border-color: #92400e !important;
}

.example-section h6 {
    color: var(--bs-warning-text, #92400e);
    font-size: 0.85rem;
    margin-bottom: 8px;
    font-weight: 600;
}

[data-bs-theme="dark"] .example-section h6,
body.dark-mode .example-section h6 {
    color: #fbbf24 !important;
}

.example-content {
    background: rgba(255, 255, 255, 0.8);
    padding: 8px;
    border-radius: 4px;
    font-size: 0.7rem;
    line-height: 1.4;
    color: #374151;
}

[data-bs-theme="dark"] .example-content,
body.dark-mode .example-content {
    background: rgba(0, 0, 0, 0.3) !important;
    color: #e5e7eb !important;
}

/* Recent requests - compact */
.recent-requests {
    background: var(--bs-info-bg-subtle, #e0f2fe);
    border: 1px solid var(--bs-info-border-subtle, #0ea5e9);
    border-radius: 8px;
    padding: 10px 12px; /* Reduced padding */
    flex: 1;
    min-height: 200px; /* Minimum height */
    max-height: 250px; /* Maximum height */
    overflow: hidden; /* No scroll */
    display: flex;
    flex-direction: column;
}

[data-bs-theme="dark"] .recent-requests,
body.dark-mode .recent-requests {
    background: #082f49 !important;
    border-color: #0369a1 !important;
}

.recent-requests h6 {
    color: var(--bs-info-text, #0369a1);
    font-size: 0.8rem; /* Smaller header */
    margin-bottom: 6px; /* Reduced margin */
    font-weight: 600;
    flex-shrink: 0; /* Don't shrink */
}

[data-bs-theme="dark"] .recent-requests h6,
body.dark-mode .recent-requests h6 {
    color: #7dd3fc !important;
}

.recent-requests-list {
    flex: 1;
    overflow: hidden; /* No scroll */
}

.request-item {
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid var(--bs-border-color, #e5e7eb);
    border-radius: 4px;
    padding: 6px 8px; /* Reduced padding */
    margin-bottom: 4px; /* Reduced margin */
    font-size: 0.65rem; /* Smaller font */
    line-height: 1.2; /* Tighter line height */
}

[data-bs-theme="dark"] .request-item,
body.dark-mode .request-item {
    background: rgba(0, 0, 0, 0.3) !important;
    border-color: #4a5568 !important;
    color: #e2e8f0 !important;
}

.request-date {
    color: var(--bs-secondary-color, #6b7280);
    font-size: 0.65rem;
    margin-bottom: 2px;
}

[data-bs-theme="dark"] .request-date,
body.dark-mode .request-date {
    color: #a0aec0 !important;
}

.compact-card {
    background: var(--bs-body-bg, white);
    border: 1px solid var(--bs-border-color, #e2e8f0);
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 15px;
}

.form-group-compact {
    margin-bottom: 12px;
}

.form-group-compact label {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--bs-body-color, #374151);
    margin-bottom: 4px;
    display: block;
}

.form-control-compact {
    padding: 8px 12px;
    border: 1px solid var(--bs-border-color, #d1d5db);
    border-radius: 6px;
    font-size: 0.9rem;
    transition: all 0.2s ease;
    background-color: var(--bs-body-bg, white) !important;
    color: var(--bs-body-color, #212529) !important;
}

.form-control-compact:focus {
    border-color: #f26b37;
    box-shadow: 0 0 0 2px rgba(242, 107, 55, 0.1);
    background-color: var(--bs-body-bg, white) !important;
    color: var(--bs-body-color, #212529) !important;
}

/* Force white background for all form inputs in light mode */
.form-control, 
.form-select, 
textarea.form-control,
input[type="text"].form-control,
input[type="number"].form-control,
input[type="date"].form-control {
    background-color: #ffffff !important;
    color: #212529 !important;
    border-color: #dee2e6 !important;
}

.form-control:focus, 
.form-select:focus,
textarea.form-control:focus,
input[type="text"].form-control:focus,
input[type="number"].form-control:focus,
input[type="date"].form-control:focus {
    background-color: #ffffff !important;
    color: #212529 !important;
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
}

/* Force white background for placeholder text */
.form-control::placeholder,
.form-select::placeholder,
textarea.form-control::placeholder {
    color: #6c757d !important;
    opacity: 1 !important;
}

.supplier-info {
    background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%) !important;
    border: 1px solid #bae6fd !important;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 15px;
}

/* Specific dark mode detection and override */
html[data-bs-theme="dark"] .form-control,
html[data-bs-theme="dark"] .form-select,
html[data-bs-theme="dark"] textarea.form-control,
html[data-bs-theme="dark"] input[type="text"].form-control,
html[data-bs-theme="dark"] input[type="number"].form-control,
html[data-bs-theme="dark"] input[type="date"].form-control,
body[data-bs-theme="dark"] .form-control,
body[data-bs-theme="dark"] .form-select,
body[data-bs-theme="dark"] textarea.form-control,
body[data-bs-theme="dark"] input[type="text"].form-control,
body[data-bs-theme="dark"] input[type="number"].form-control,
body[data-bs-theme="dark"] input[type="date"].form-control {
    background-color: #ffffff !important;
    color: #212529 !important;
    border-color: #dee2e6 !important;
}

html[data-bs-theme="dark"] .form-control:focus,
html[data-bs-theme="dark"] .form-select:focus,
html[data-bs-theme="dark"] textarea.form-control:focus,
html[data-bs-theme="dark"] input[type="text"].form-control:focus,
html[data-bs-theme="dark"] input[type="number"].form-control:focus,
html[data-bs-theme="dark"] input[type="date"].form-control:focus,
body[data-bs-theme="dark"] .form-control:focus,
body[data-bs-theme="dark"] .form-select:focus,
body[data-bs-theme="dark"] textarea.form-control:focus,
body[data-bs-theme="dark"] input[type="text"].form-control:focus,
body[data-bs-theme="dark"] input[type="number"].form-control:focus,
body[data-bs-theme="dark"] input[type="date"].form-control:focus {
    background-color: #ffffff !important;
    color: #212529 !important;
    border-color: #f26b37 !important;
    box-shadow: 0 0 0 0.2rem rgba(242, 107, 55, 0.25) !important;
}

/* Force white placeholder in dark mode */
html[data-bs-theme="dark"] .form-control::placeholder,
html[data-bs-theme="dark"] .form-select::placeholder,
html[data-bs-theme="dark"] textarea.form-control::placeholder,
body[data-bs-theme="dark"] .form-control::placeholder,
body[data-bs-theme="dark"] .form-select::placeholder,
body[data-bs-theme="dark"] textarea.form-control::placeholder {
    color: #6c757d !important;
    opacity: 1 !important;
}

/* Card backgrounds */
[data-bs-theme="dark"] .compact-card {
    background: #1a202c !important;
    border-color: #4a5568 !important;
}

[data-bs-theme="dark"] .sidebar-section {
    background: #2d3748 !important;
    border-color: #4a5568 !important;
}

[data-bs-theme="dark"] .supplier-info {
    background: #2d3748 !important;
    border-color: #4a5568 !important;
}

.priority-options {
    display: flex;
    gap: 10px;
    margin-top: 8px;
}

.priority-radio {
    flex: 1;
    position: relative;
}

.priority-radio input[type="radio"] {
    display: none;
}

.priority-label {
    display: block;
    padding: 8px 12px;
    border: 2px solid var(--bs-border-color, #e5e7eb);
    border-radius: 6px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.85rem;
    font-weight: 600;
    background: var(--bs-body-bg, white);
    color: var(--bs-body-color, #6b7280);
}

.priority-radio input[type="radio"]:checked + .priority-label {
    border-color: #f26b37;
    background: rgba(242, 107, 55, 0.1);
    color: #f26b37;
}

/* Dark mode priority styling */
[data-bs-theme="dark"] .priority-label {
    background: #2d3748 !important;
    color: #e2e8f0 !important;
    border-color: #4a5568 !important;
}

[data-bs-theme="dark"] .priority-radio input[type="radio"]:checked + .priority-label {
    background: rgba(242, 107, 55, 0.2) !important;
    color: #f26b37 !important;
    border-color: #f26b37 !important;
}

.action-buttons {
    background: var(--bs-gray-100, #f8fafc);
    padding: 15px 20px;
    border-top: 1px solid var(--bs-border-color, #e2e8f0);
    border-radius: 0 0 12px 12px;
    display: flex;
    gap: 10px;
    justify-content: flex-end;
    flex-shrink: 0;
}

/* Dark mode action buttons */
[data-bs-theme="dark"] .action-buttons {
    background: #2d3748 !important;
    border-color: #4a5568 !important;
}

.btn-modern {
    background: linear-gradient(135deg, #f26b37, #e55827);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-modern:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(242, 107, 55, 0.3);
    color: white;
}

.btn-outline-modern {
    background: transparent;
    color: var(--bs-body-color, #6b7280);
    border: 2px solid var(--bs-border-color, #e5e7eb);
    padding: 8px 18px;
    border-radius: 6px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-modern:hover {
    border-color: #f26b37;
    color: #f26b37;
    background: rgba(242, 107, 55, 0.05);
}

/* Dark mode button styling */
[data-bs-theme="dark"] .btn-outline-modern {
    color: #e2e8f0 !important;
    border-color: #4a5568 !important;
}

[data-bs-theme="dark"] .btn-outline-modern:hover {
    border-color: #f26b37 !important;
    color: #f26b37 !important;
    background: rgba(242, 107, 55, 0.1) !important;
}

.tips-section {
    background: var(--bs-success-bg-subtle, #f0fdfa);
    border: 1px solid var(--bs-success-border-subtle, #a7f3d0);
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
}

.tips-section h6 {
    color: var(--bs-success-text, #065f46);
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.tips-list li {
    font-size: 0.85rem;
    color: var(--bs-success-text, #047857);
    margin-bottom: 6px;
    position: relative;
    padding-left: 20px;
}

.tips-list li:before {
    content: '✓';
    position: absolute;
    left: 0;
    color: var(--bs-success, #10b981);
    font-weight: bold;
}

/* Dark mode tips section */
[data-bs-theme="dark"] .tips-section {
    background: #1a2f23 !important;
    border-color: #2d5a41 !important;
}

[data-bs-theme="dark"] .tips-section h6 {
    color: #86efac !important;
}

[data-bs-theme="dark"] .tips-list li {
    color: #bbf7d0 !important;
}

[data-bs-theme="dark"] .tips-list li:before {
    color: #86efac !important;
}

.recent-requests {
    background: var(--bs-purple-bg-subtle, #fef7ff);
    border: 1px solid var(--bs-purple-border-subtle, #e9d5ff);
    border-radius: 8px;
    padding: 15px;
}

.recent-requests h6 {
    color: var(--bs-purple-text, #7c3aed);
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.request-item {
    background: var(--bs-body-bg, white);
    border: 1px solid var(--bs-border-color, #e5e7eb);
    border-radius: 6px;
    padding: 10px;
    margin-bottom: 8px;
    font-size: 0.8rem;
}

.request-date {
    color: var(--bs-secondary-color, #6b7280);
    font-size: 0.75rem;
}

/* Dark mode recent requests */
[data-bs-theme="dark"] .recent-requests {
    background: #2d1b3d !important;
    border-color: #5b21b6 !important;
}

[data-bs-theme="dark"] .recent-requests h6 {
    color: #c4b5fd !important;
}

[data-bs-theme="dark"] .request-item {
    background: #1a202c !important;
    border-color: #4a5568 !important;
    color: #e2e8f0 !important;
}

[data-bs-theme="dark"] .request-date {
    color: #a0aec0 !important;
}

/* Responsive Design - No Scroll Mobile Layout */
@media (max-width: 768px) {
    .request-product-container {
        height: calc(100vh - 60px);
        margin: 5px;
    }
    
    .request-content {
        flex-direction: column;
        height: calc(100% - 60px);
    }
    
    .sidebar-section {
        width: 100%;
        height: auto;
        max-height: 180px;
        order: -1;
        padding: 10px;
        overflow-y: auto;
        flex-direction: row;
        gap: 10px;
    }
    
    .sidebar-section > div {
        flex: 1;
        margin-bottom: 0;
        margin-right: 10px;
        min-width: 120px;
    }
    
    .sidebar-section > div:last-child {
        margin-right: 0;
    }
    
    .tips-section,
    .example-section,
    .recent-requests {
        height: 140px; /* Fixed height for mobile */
        overflow: hidden; /* No scroll on mobile */
        font-size: 0.8rem;
    }
    
    .tips-section h6,
    .example-section h6,
    .recent-requests h6 {
        font-size: 0.75rem;
        margin-bottom: 6px;
    }
    
    .tips-list li {
        font-size: 0.65rem;
        margin-bottom: 2px;
        padding-left: 12px;
    }
    
    .example-content {
        font-size: 0.6rem;
        padding: 6px;
    }
    
    .request-item {
        font-size: 0.6rem;
        padding: 6px;
        margin-bottom: 4px;
    }
    
    .form-section {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .compact-card {
        padding: 12px;
        margin-bottom: 12px;
    }
    
    .action-buttons {
        padding: 10px;
        flex-direction: column;
        gap: 8px;
    }
    
    .priority-options {
        flex-direction: column;
        gap: 8px;
    }
    
    .request-header {
        padding: 12px 15px;
    }
    
    .request-header h5 {
        font-size: 1.1rem;
    }
}
    }
}
</style>

<div class="request-product-container">
    <!-- Header -->
    <div class="request-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-box me-2"></i>Form Request Produk</h5>
            <a href="{{ route('gudang.chat.show', $chatRoom->id) }}" class="btn btn-back-chat">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Chat
            </a>
        </div>
    </div>

    <div class="request-content">
        <!-- Form Section -->
        <div class="form-section">
            <!-- Supplier Info -->
            <div class="supplier-info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong><i class="fas fa-building me-2"></i>{{ $chatRoom->pemasok->nama_perusahaan }}</strong><br>
                        <small>{{ $chatRoom->pemasok->kontak_person }} - {{ $chatRoom->pemasok->telepon }}</small>
                    </div>
                    <div class="text-end">
                        <span class="badge" style="background: #f26b37;">{{ $chatRoom->pemasok->kategori_produk }}</span><br>
                        <small class="text-muted">{{ $chatRoom->pemasok->kota }}</small>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-sm">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('gudang.chat.send-product-request', $chatRoom->id) }}" method="POST" id="requestForm">
                @csrf
                
                <!-- Informasi Produk -->
                <div class="compact-card">
                    <h6 class="text-primary mb-3"><i class="fas fa-info-circle me-2"></i>Informasi Produk</h6>
                    
                    <div class="form-group-compact">
                        <label for="nama_produk">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-compact @error('nama_produk') is-invalid @enderror" 
                               id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" required>
                        @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group-compact">
                            <label for="kategori">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control form-control-compact @error('kategori') is-invalid @enderror" 
                                    id="kategori" name="kategori" required>
                                <option value="">Pilih Kategori...</option>
                                <option value="Makanan & Minuman" {{ old('kategori') == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                                <option value="Perawatan Tubuh" {{ old('kategori') == 'Perawatan Tubuh' ? 'selected' : '' }}>Perawatan Tubuh</option>
                                <option value="Rumah Tangga" {{ old('kategori') == 'Rumah Tangga' ? 'selected' : '' }}>Rumah Tangga</option>
                                <option value="Elektronik" {{ old('kategori') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="Fashion" {{ old('kategori') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="Olahraga" {{ old('kategori') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                                <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group-compact">
                            <label for="spesifikasi">Spesifikasi / Deskripsi</label>
                            <textarea class="form-control form-control-compact @error('spesifikasi') is-invalid @enderror" 
                                      id="spesifikasi" name="spesifikasi" rows="3" 
                                      placeholder="Contoh: Ukuran, warna, merk, bahan, dll...">{{ old('spesifikasi') }}</textarea>
                            @error('spesifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Detail Permintaan -->
                <div class="compact-card">
                    <h6 class="text-primary mb-3"><i class="fas fa-clipboard-list me-2"></i>Detail Permintaan</h6>
                    
                    <div class="form-row">
                        <div class="form-group-compact">
                            <label for="jumlah">Jumlah <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-compact @error('jumlah') is-invalid @enderror" 
                                   id="jumlah" name="jumlah" value="{{ old('jumlah') }}" min="1" required>
                            @error('jumlah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group-compact">
                            <label for="satuan">Satuan <span class="text-danger">*</span></label>
                            <select class="form-control form-control-compact @error('satuan') is-invalid @enderror" 
                                    id="satuan" name="satuan" required>
                                <option value="">Pilih...</option>
                                <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                                <option value="box" {{ old('satuan') == 'box' ? 'selected' : '' }}>Box</option>
                                <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kilogram</option>
                                <option value="gram" {{ old('satuan') == 'gram' ? 'selected' : '' }}>Gram</option>
                                <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>Liter</option>
                                <option value="ml" {{ old('satuan') == 'ml' ? 'selected' : '' }}>Mililiter</option>
                                <option value="meter" {{ old('satuan') == 'meter' ? 'selected' : '' }}>Meter</option>
                                <option value="cm" {{ old('satuan') == 'cm' ? 'selected' : '' }}>Centimeter</option>
                                <option value="set" {{ old('satuan') == 'set' ? 'selected' : '' }}>Set</option>
                                <option value="pack" {{ old('satuan') == 'pack' ? 'selected' : '' }}>Pack</option>
                                <option value="dozen" {{ old('satuan') == 'dozen' ? 'selected' : '' }}>Dozen</option>
                                <option value="lusin" {{ old('satuan') == 'lusin' ? 'selected' : '' }}>Lusin</option>
                            </select>
                            @error('satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group-compact">
                            <label for="harga_maksimal">Harga Maksimal (per satuan)</label>
                            <input type="number" class="form-control form-control-compact @error('harga_maksimal') is-invalid @enderror" 
                                   id="harga_maksimal" name="harga_maksimal" value="{{ old('harga_maksimal') }}" min="0" step="0.01"
                                   placeholder="Opsional">
                            <small class="text-muted">Kosongkan jika tidak ada batasan harga</small>
                            @error('harga_maksimal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group-compact">
                            <label for="tanggal_dibutuhkan">Tanggal Dibutuhkan</label>
                            <input type="date" class="form-control form-control-compact @error('tanggal_dibutuhkan') is-invalid @enderror" 
                                   id="tanggal_dibutuhkan" name="tanggal_dibutuhkan" value="{{ old('tanggal_dibutuhkan') }}">
                            @error('tanggal_dibutuhkan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group-compact">
                        <label for="catatan_tambahan">Catatan Tambahan</label>
                        <textarea class="form-control form-control-compact @error('catatan_tambahan') is-invalid @enderror" 
                                  id="catatan_tambahan" name="catatan_tambahan" rows="2" 
                                  placeholder="Informasi tambahan, syarat khusus, dll...">{{ old('catatan_tambahan') }}</textarea>
                        @error('catatan_tambahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tingkat Prioritas -->
                <div class="compact-card">
                    <h6 class="text-primary mb-3"><i class="fas fa-exclamation-triangle me-2"></i>Tingkat Prioritas</h6>
                    
                    <div class="priority-options">
                        <div class="priority-radio">
                            <input type="radio" id="rendah" name="prioritas" value="rendah" {{ old('prioritas', 'normal') == 'rendah' ? 'checked' : '' }}>
                            <label for="rendah" class="priority-label">
                                <i class="fas fa-minus-circle me-1"></i>Rendah<br>
                                <small>Tidak mendesak</small>
                            </label>
                        </div>
                        
                        <div class="priority-radio">
                            <input type="radio" id="normal" name="prioritas" value="normal" {{ old('prioritas', 'normal') == 'normal' ? 'checked' : '' }}>
                            <label for="normal" class="priority-label">
                                <i class="fas fa-circle me-1"></i>Normal<br>
                                <small>Standar</small>
                            </label>
                        </div>
                        
                        <div class="priority-radio">
                            <input type="radio" id="tinggi" name="prioritas" value="tinggi" {{ old('prioritas') == 'tinggi' ? 'checked' : '' }}>
                            <label for="tinggi" class="priority-label">
                                <i class="fas fa-exclamation-circle me-1"></i>Tinggi<br>
                                <small>Mendesak</small>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="sidebar-section">
            <!-- Tips -->
            <div class="tips-section">
                <h6><i class="fas fa-lightbulb me-1"></i>Tips Mengisi Form:</h6>
                <ul class="tips-list">
                    <li>Sertakan spesifikasi yang detail</li>
                    <li>Tentukan jumlah dan satuan dengan tepat</li>
                    <li>Berikan batasan harga jika ada</li>
                    <li>Tentukan deadline yang realistis</li>
                    <li>Pilih prioritas sesuai kebutuhan</li>
                </ul>
            </div>

            <!-- Contoh Spesifikasi -->
            <div class="example-section">
                <h6><i class="fas fa-star me-1"></i>Contoh Spesifikasi yang Baik:</h6>
                <div class="example-content">
                    <strong>Nama:</strong> Minyak Goreng<br>
                    <strong>Spesifikasi:</strong> Merk Bimoli, kemasan 2 liter, botol plastik, tanpa pengawet<br>
                    <strong>Jumlah:</strong> 50 botol<br>
                    <strong>Harga Max:</strong> Rp 35.000/botol
                </div>
            </div>

            <!-- Request Terakhir -->
            <div class="recent-requests">
                <h6><i class="fas fa-history me-1"></i>Request Terakhir:</h6>
                @php
                    $recentRequests = $chatRoom->messages()
                        ->where('message_type', 'product_request')
                        ->latest()
                        ->take(3)
                        ->get();
                @endphp
                
                @if($recentRequests->count() > 0)
                    @foreach($recentRequests as $request)
                        <div class="request-item">
                            <div class="request-date">{{ $request->created_at->format('d/m/Y') }}</div>
                            @if($request->product_data && isset($request->product_data['nama_produk']))
                                <strong>{{ $request->product_data['nama_produk'] }}</strong>
                                @if(isset($request->product_data['jumlah']) && isset($request->product_data['satuan']))
                                    <br><small>{{ $request->product_data['jumlah'] }} {{ $request->product_data['satuan'] }}</small>
                                @endif
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="request-item">
                        <small class="text-muted">Belum ada request sebelumnya</small>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <button type="button" class="btn btn-outline-modern" onclick="window.history.back()">
            <i class="fas fa-times me-2"></i>Batal
        </button>
        <button type="submit" form="requestForm" class="btn btn-modern">
            <i class="fas fa-paper-plane me-2"></i>Kirim Request Produk
        </button>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Detect and apply theme-appropriate styling
    function applyThemeToInputs() {
        const isDarkMode = document.body.classList.contains('dark-mode') || 
                          document.documentElement.getAttribute('data-bs-theme') === 'dark' ||
                          $('body').hasClass('dark-mode') || 
                          $('html').attr('data-bs-theme') === 'dark';
        
        console.log('Dark mode detected:', isDarkMode);
        
        // Let CSS handle the styling naturally
        // Remove any conflicting inline styles
        $('.request-product-container input, .request-product-container select, .request-product-container textarea').each(function() {
            $(this).removeAttr('style');
        });
        
        // Force refresh of styles
        $('.request-product-container').removeClass('theme-applied').addClass('theme-applied');
    }
    
    // Apply theme immediately and on changes
    applyThemeToInputs();
    
    // Monitor for theme changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && 
                (mutation.attributeName === 'class' || mutation.attributeName === 'data-bs-theme')) {
                setTimeout(applyThemeToInputs, 50);
            }
        });
    });
    
    observer.observe(document.body, {
        attributes: true,
        attributeFilter: ['class', 'data-bs-theme']
    });
    
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class', 'data-bs-theme']
    });
    
    // Set minimum date to tomorrow
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    $('#tanggal_dibutuhkan').attr('min', tomorrow.toISOString().split('T')[0]);

    // Form validation enhancement
    $('#requestForm').on('submit', function(e) {
        const jumlah = $('#jumlah').val();
        const satuan = $('#satuan').val();
        const namaProduk = $('#nama_produk').val();

        if (!namaProduk || !jumlah || !satuan) {
            e.preventDefault();
            alert('Mohon lengkapi minimal Nama Produk, Jumlah, dan Satuan');
            return false;
        }

        // Show loading state
        $(this).find('button[type="submit"]')
               .prop('disabled', true)
               .html('<i class="fas fa-spinner fa-spin me-2"></i>Mengirim Request...');
    });

    // Auto-resize textarea
    $('textarea').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // Format number input for harga_maksimal
    $('#harga_maksimal').on('input', function() {
        let value = $(this).val();
        if (value) {
            // Add thousand separator preview
            let formatted = new Intl.NumberFormat('id-ID').format(value);
            $(this).attr('title', 'Rp ' + formatted);
        }
    });

    // Quick select common categories
    $('#kategori').on('change', function() {
        const kategori = $(this).val();
        let suggestions = [];
        
        switch(kategori) {
            case 'Makanan & Minuman':
                suggestions = ['pcs', 'box', 'kg', 'liter'];
                break;
            case 'Rumah Tangga':
                suggestions = ['pcs', 'set', 'pack', 'box'];
                break;
            case 'Perawatan Tubuh':
                suggestions = ['pcs', 'ml', 'box', 'set'];
                break;
            default:
                suggestions = ['pcs', 'box', 'set'];
        }
        
        // Update satuan options based on category
        const satuanSelect = $('#satuan');
        const currentValue = satuanSelect.val();
        
        // Keep current selection if valid
        if (suggestions.includes(currentValue)) {
            return;
        }
        
        // Suggest first common unit for this category
        if (suggestions.length > 0 && !satuanSelect.val()) {
            satuanSelect.val(suggestions[0]);
        }
    });

    // Priority selection styling
    $('input[name="prioritas"]').on('change', function() {
        $('.priority-label').removeClass('selected');
        $(this).next('.priority-label').addClass('selected');
    });

    // Initialize selected priority
    $('input[name="prioritas"]:checked').next('.priority-label').addClass('selected');
});
</script>
@endpush
