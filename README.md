
# Form Submission with Webhook and Redirect

This project implements a simple, customizable HTML form with frontend validations, UTM tracking, and webhook integration. It allows seamless submission of user data to a specified webhook URL, followed by a redirect to a "Thank You" page.

## Features

- **Frontend Validation**: Validates the `Name`, `Email`, and `WhatsApp Number` fields in the browser before form submission.
- **Dynamic UTM Tracking**: Automatically captures and includes UTM parameters (`utm_source`, `utm_medium`, etc.) from the URL.
- **Country Code Detection**: Detects the user's country code based on their IP address and auto-fills it in the form.
- **Webhook and Redirect**: Posts the form data to a specified webhook URL and redirects the user to a Thank You page.

---

## Installation

1. Clone the repository or download the files.
   ```bash
   git clone https://github.com/your-username/your-repo-name.git
   cd your-repo-name
   ```

2. Place the `form.html` file on your web server.

3. Create a `submit.php` file (if using PHP for submission) to handle the form data, or point the form's `action` attribute to your webhook.

---

## Setup

### 1. Update Webhook and Redirect URLs

Edit the `form.html` file and update the following lines in the `<script>` section with your actual webhook and redirect URLs:

```javascript
const webhookURL = "https://YOUR-WEBHOOK-URL.com"; // Replace with your webhook URL
const redirectURL = "https://YOUR-REDIRECT-URL.com"; // Replace with your Thank You page URL
```

### 2. Deploy

Upload the `form.html` to your server.

---

## How It Works

1. **Frontend Validation**:
   - The form validates the `Name` (minimum 2 characters), `Email` (valid email format), and `WhatsApp Number` fields.
   - If validation fails, an inline error popup appears next to the invalid field.

2. **Country Code Detection**:
   - The form fetches the user's country calling code using the IPAPI service (`https://ipapi.co/json/`) and pre-fills the country code field. If the detection fails, it defaults to `91`.

3. **UTM Tracking**:
   - UTM parameters (`utm_source`, `utm_medium`, `utm_campaign`, `utm_term`, `utm_content`) are captured from the URL query string and included in the form data.

4. **Submission**:
   - On successful validation, the form submits the data to the webhook URL specified in the `webhookURL` variable.
   - After submission, the user is redirected to the Thank You page defined in the `redirectURL` variable.

---

## Code Customization

### Form Fields

You can customize the form fields by editing the `<form>` section in `form.html`. Add or remove fields as necessary while maintaining appropriate `name` attributes for consistency with your webhook or backend.

### Style Customization

The form's appearance is styled using inline CSS and a `<style>` block in `form.html`. Modify styles directly in the file to match your design requirements.

---

## Dependencies

- **IPAPI Service**: Used to fetch the user's country calling code. No additional libraries or frameworks are required.

---

## Example Payload

Here’s an example JSON payload sent to the webhook:

```json
{
  "name": "John Doe",
  "email": "john.doe@example.com",
  "countryCode": "91",
  "whatsappNumber": "9876543210",
  "utm_source": "google",
  "utm_medium": "cpc",
  "utm_campaign": "holiday_sale",
  "utm_term": "discount",
  "utm_content": "ad1"
}
```

---

## Troubleshooting

1. **Country Code Defaulting to 91**:
   - If the IP-based lookup fails, the form defaults the country code to `91`.

2. **Validation Errors**:
   - Ensure all required fields are filled correctly.
   - Check your browser console for error messages.

3. **Server Errors**:
   - Verify that your webhook URL is reachable and correctly configured to handle the JSON payload.

---

## License

This project is open-source and available under the [MIT License](LICENSE).
