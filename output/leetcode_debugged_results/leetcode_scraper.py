# python leetcode_scraper.py

import requests, json
import time
from requests.adapters import HTTPAdapter
from urllib3.util.retry import Retry

# === Replace with your LeetCode cookies from browser ===
cookies = {
     "LEETCODE_SESSION": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfYXV0aF91c2VyX2lkIjoiMTc5Nzg3MjYiLCJfYXV0aF91c2VyX2JhY2tlbmQiOiJkamFuZ28uY29udHJpYi5hdXRoLmJhY2tlbmRzLk1vZGVsQmFja2VuZCIsIl9hdXRoX3VzZXJfaGFzaCI6IjNmMzU3ODI2NDcwZGNmNDNiMmE1OGVlZDBhYWZmMjMyMTgxZDNlMDBlZTgzZmU1Mzg0MzlkMDhkOGNlNDI4YzgiLCJzZXNzaW9uX3V1aWQiOiI0ODg3MDk3YSIsImlkIjoxNzk3ODcyNiwiZW1haWwiOiJzYWdlZXJ0LXNlMjAwMjVAc3R1Lmtsbi5hYy5sayIsInVzZXJuYW1lIjoic2FnZWVydGhhbjMwIiwidXNlcl9zbHVnIjoic2FnZWVydGhhbjMwIiwiYXZhdGFyIjoiaHR0cHM6Ly9hc3NldHMubGVldGNvZGUuY29tL3VzZXJzL2RlZmF1bHRfYXZhdGFyLmpwZyIsInJlZnJlc2hlZF9hdCI6MTc2NTM0MzM3NCwiaXAiOiIyMTIuMTA0LjIzMS4yNTMiLCJpZGVudGl0eSI6Ijg5ZGI3MjljZmNkYzEyOTExMWYwMTdiMGU3YWMzMjRhIiwiZGV2aWNlX3dpdGhfaXAiOlsiNjIxOGJhMzcxZjdkZTVhZmViNDk2ZjFmMTFiYjUxODkiLCIyMTIuMTA0LjIzMS4yNTMiXSwiX3Nlc3Npb25fZXhwaXJ5IjoxMjA5NjAwfQ.fzGkfm1PWiqxhK24-xetCofBYjiGZXRhLIJLaXdROPk",
     "csrftoken": "j6R4DmvGqyi6QuTsY9r2sOV4YF4KqMLD"
}

# Create a session with retry logic
session = requests.Session()
retry_strategy = Retry(
    total=3,
    backoff_factor=1,
    status_forcelist=[429, 500, 502, 503, 504],
)
adapter = HTTPAdapter(max_retries=retry_strategy)
session.mount("https://", adapter)
session.mount("http://", adapter)

# First, test if cookies are still valid by making a simple request
try:
    test_resp = session.get(
        "https://leetcode.com/api/submissions/?offset=0&limit=1",
        cookies=cookies,
        timeout=10
    )
    if test_resp.status_code == 403:
        print("❌ Cookies are invalid or expired. Please update your cookies from your browser.")
        exit(1)
    test_resp.raise_for_status()
    print("✅ Cookies are valid")
except Exception as e:
    print(f"❌ Error testing cookies: {e}")
    print("Please check if your cookies are still valid and update them.")
    exit(1)

# Step 1: Get recent submissions
try:
    headers = {
        "Content-Type": "application/json",
        "Referer": "https://leetcode.com",
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
    }
    
    resp = session.get(
        "https://leetcode.com/api/submissions/?offset=0&limit=5",
        cookies=cookies,
        headers=headers,
        timeout=30
    )
    resp.raise_for_status()
    data = resp.json()
    submissions = data.get("submissions_dump", [])
    print(f"Found {len(submissions)} submissions")
    
    if not submissions:
        print("No submissions found. Your cookies might not have access to submissions.")
        exit(1)
        
except Exception as e:
    print(f"Error fetching submissions: {e}")
    exit(1)

final_results = []

# Step 2: Fetch code for each submission with delays
for i, sub in enumerate(submissions):
    submission_id = sub["id"]
    print(f"Processing submission {i+1}/{len(submissions)}: {submission_id}")

    # Prepare the GraphQL query with correct field names based on error messages
    query = {
        "operationName": "submissionDetails",
        "variables": {"submissionId": str(submission_id)},
        "query": """
        query submissionDetails($submissionId: Int!) {
          submissionDetails(submissionId: $submissionId) {
            id
            lang {
              name
              verboseName
            }
            code
            timestamp
            statusCode
            totalTestcases
            question {
              title
              titleSlug
              questionId
            }
          }
        }
        """
    }

    try:
        # Get a fresh CSRF token for each request
        csrf_headers = headers.copy()
        csrf_headers["x-csrftoken"] = cookies["csrftoken"]
        
        # Make the GraphQL request
        detail_resp = session.post(
            "https://leetcode.com/graphql/",
            json=query,
            cookies=cookies,
            headers=csrf_headers,
            timeout=30
        )
        
        # Check for HTTP errors
        detail_resp.raise_for_status()
        detail_data = detail_resp.json()
        
        # Check if there are GraphQL errors
        if "errors" in detail_data:
            print(f"GraphQL errors for submission {submission_id}:")
            for error in detail_data['errors']:
                print(f"  - {error.get('message', 'Unknown error')}")
            continue
        
        # Check if data exists in the response
        if "data" not in detail_data or "submissionDetails" not in detail_data["data"]:
            print(f"No submissionDetails found for submission {submission_id}")
            print(f"Response: {json.dumps(detail_data, indent=2)[:300]}...")
            continue

        detail = detail_data["data"]["submissionDetails"]
        
        # Check if the submission details are null
        if detail is None:
            print(f"Submission {submission_id} details are null (might be deleted)")
            continue

        # Flatten lang field for convenience
        if "lang" in detail and isinstance(detail["lang"], dict):
            detail["lang"] = detail["lang"]["name"]

        # Map statusCode to status_display for consistency
        status_code_map = {
            10: "Accepted",
            11: "Wrong Answer",
            12: "Memory Limit Exceeded",
            13: "Output Limit Exceeded",
            14: "Time Limit Exceeded",
            15: "Runtime Error",
            16: "Internal Error",
            20: "Compile Error",
            21: "Unknown Error",
            30: "Timeout"
        }
        
        detail["status_display"] = status_code_map.get(detail.get("statusCode"), "Unknown")
        detail["status_code"] = detail.get("statusCode")

        # For passed test cases, we can infer from statusCode
        # If status is 10 (Accepted), then all test cases passed
        if detail.get("statusCode") == 10:
            detail["passedTestCaseCnt"] = detail.get("totalTestcases", 0)
            detail["totalTestCaseCnt"] = detail.get("totalTestcases", 0)
        # else:
        #     # For other statuses, use API-provided counts if available
        #     detail["passedTestCaseCnt"] = detail.get("totalCorrect", 0)   
        #     detail["totalTestCaseCnt"] = detail.get("totalTestcases", 0) 

        else:
              # For other statuses, calculate passed test cases from compare_result
              compare_result = sub.get("compare_result", "")
              if compare_result:
                # Count the number of '1's in compare_result string (passed tests)
                passed_count = compare_result.count('1')
                detail["passedTestCaseCnt"] = passed_count
              else:
                detail["passedTestCaseCnt"] = 0
              detail["totalTestCaseCnt"] = detail.get("totalTestcases", 0)
        # Merge metadata with code
        merged = {**sub, **detail}
        final_results.append(merged)
        
        print(f"✓ Successfully processed submission {submission_id}")

    except requests.exceptions.HTTPError as e:
        print(f"HTTP error for submission {submission_id}: {e}")
        if 'detail_resp' in locals():
            print(f"Response status: {detail_resp.status_code}")
            print(f"Response text: {detail_resp.text[:500]}...")  # Show more of the response for debugging
        continue
    except requests.exceptions.RequestException as e:
        print(f"Request error for submission {submission_id}: {e}")
        continue
    except Exception as e:
        print(f"Unexpected error for submission {submission_id}: {e}")
        continue

    # Add delay between requests to avoid rate limiting
    if i < len(submissions) - 1:
        time.sleep(3)

# Step 3: Save in the required format
if final_results:
    with open("leetcode_submissions.json", "w", encoding="utf-8") as f:
        json.dump({"submissions_dump": final_results}, f, indent=2)
    print(f"✅ Successfully saved {len(final_results)} submissions to leetcode_submissions.json")
else:
    print("❌ No submissions were successfully processed")
    print("This could be due to:")
    print("1. Invalid GraphQL query fields")
    print("2. Rate limiting by LeetCode")
    print("3. Submissions that have been deleted")
    print("4. Changes to the LeetCode API")

print("Script completed")