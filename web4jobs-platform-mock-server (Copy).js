/**
 * Insertion Platform - Single & Batch Event Mock Sender
 * Run with: node insertion_sender.js
 */

const BASE_URL = 'http://localhost:8000/api'; // Update to match your server URL
const PLATFORM_SOURCE = 'web4jobs_progress';

// Helper function to format date exactly to Y-m-d\TH:i:s\Z (stripping milliseconds)
function getStrictIsoTimestamp() {
    return new Date().toISOString().replace(/\.\d{3}/, ''); 
}

function createSingleEventPayload() {
    const timestamp = Date.now();
    return {
        source: PLATFORM_SOURCE,
        event_type: "course_progress_updated",
        external_user_id: "1002",
        learner_email: "braulio.kutch@example.org",
        metric_key: "passport_numerique_progress", 
        value: 85,
        previous_value: 60,
        entity_type: "course",
        entity_id: "INS-1024",
        happened_at: getStrictIsoTimestamp(),
        metadata: {
            completed_sections: ["personal_info", "cv", "skills", "portfolio"]
        },
        dedupe_key: `insertion:INS-10258:profile_completion_updated:INS-1024:${timestamp}`
    };
}

function createBatchEventsPayload() {
    const timestamp = Date.now();
    return {
        source: PLATFORM_SOURCE,
        events: [
            {
                source: PLATFORM_SOURCE,
                event_type: "rna_progress_updated",
                external_user_id: "1002",
                learner_email: "braulio.kutch@example.org",
                metric_key: "rna_progress",
                value: 10,
                previous_value: 5,
                entity_type: "cv",
                entity_id: "CV-9910",
                happened_at: getStrictIsoTimestamp(),
                metadata: { file_type: "pdf" },
                // FIX: Unique key for item 0
                dedupe_key: `insertion:INS-1002:cv_uploaded:CV-9910:${timestamp}_0`
            },
            {
                source: PLATFORM_SOURCE,
                event_type: "formation_progress_updated",
                external_user_id: "1002",
                learner_email: "braulio.kutch@example.org",
                metric_key: "pm_formation_progress",
                value: 90,
                previous_value: 50,
                entity_type: "job_offer",
                entity_id: "OFF-890",
                happened_at: getStrictIsoTimestamp(),
                metadata: { channel: "mobile_app" },
                // FIX: Unique key for item 1
                dedupe_key: `insertion:INS-1002:offer_applied:OFF-890:${timestamp}_1`
            }
        ]
    };
}

async function sendRequest(endpoint, payload, label) {
    const url = `${BASE_URL.replace(/\/$/, '')}${endpoint}`;
    console.log(`\n🚀 Sending [${label}] to: ${url}`);
    console.log(`🔑 Header -> X-API-Key: "${PLATFORM_SOURCE}"`);
    
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-API-Key': PLATFORM_SOURCE
            },
            body: JSON.stringify(payload)
        });

        console.log(`🔹 Status Code: ${response.status}`);
        const text = await response.text();
        
        try {
            const json = JSON.parse(text);
            console.dir(json, { depth: null, colors: true });
        } catch {
            console.log(`🔹 Response (Raw Text): ${text}`);
        }
    } catch (error) {
        console.error(`❌ Request Failed: ${error.message}`);
    }
}

async function runTests() {
    // 1. Single Event Test
    await sendRequest('/gamification/web4jobs/events', createSingleEventPayload(), 'Web4Jobs Platform: Single Event');

    // Wait 1 second to keep timestamps distinct
    await new Promise(resolve => setTimeout(resolve, 1000));

    // 2. Batch Events Test
    await sendRequest('/gamification/web4jobs/events/batch', createBatchEventsPayload(), 'Web4Jobs Platform: Batch Events');
}

runTests();
