export function getAPIBaseURL() {
    const meta = document.querySelector('meta[name="api-base"]');
    return meta ? meta.content : '';
}