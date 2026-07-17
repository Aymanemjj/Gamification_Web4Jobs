/**
 * Gamification Backend Test Request Sender
 * Run with: node mock_sender.js
 */

const BASE_URL = 'http://localhost:8000/api'; // Update to match your server URL

// --- Payloads definitions from structures ---

const w4jPayload = {
    source: "web4jobs_progress",
    event_type: "course_progress_updated",
    external_user_id: "W4J-1024",
    learner_email: "student@example.com",
    metric_key: "passport_numerique_progress",
    value: 75,
    previous_value: 40,
    entity_type: "course",
    entity_id: "passport-numerique",
    happened_at: new Date().toISOString(),
    metadata: {
        course_name: "Passeport numérique",
        module_name: "Introduction au numérique",
        progress_unit: "percentage",
    },
    dedupe_key: `web4jobs:W4J-1024:passport_numerique_progress:${Date.now()}`,
};

const manualContributionPayload = {
    source: "manual_contribution",
    event_type: "volunteer_contribution_validated",
    external_user_id: "CENTER-1024",
    learner_email: "student@example.com",
    metric_key: "volunteer_contribution",
    value: 1,
    previous_value: null,
    entity_type: "manual_contribution",
    entity_id: "manual-contribution-001",
    center_id: "CASA-01",
    happened_at: new Date().toISOString(),
    metadata: {
        contribution_title: "Aide à l’organisation d’un atelier",
        contribution_category: "volunteering",
        description: "Le learner a aidé l’équipe à préparer et organiser un atelier au centre.",
        validated_by: "admin-center-01",
        validator_role: "center_manager",
        validation_status: "validated",
        evidence_type: "admin_validation",
        evidence_url: null,
        duration_minutes: 120,
        impact_level: "medium",
    },
    dedupe_key: `manual:CENTER-1024:volunteer_contribution:${Date.now()}`,
};

const insertionPayload = {
    source: "insertion_platform",
    event_type: "profile_completion_updated",
    external_user_id: "INS-1024",
    learner_email: "student@example.com",
    metric_key: "insertion_profile_completion",
    value: 85,
    previous_value: 60,
    entity_type: "profile",
    entity_id: "INS-1024",
    happened_at: new Date().toISOString(),
    metadata: {
        completed_sections: ["personal_info", "cv", "skills", "portfolio"],
    },
    dedupe_key: `insertion:INS-1024:profile_completion_updated:${Date.now()}`,
};

const forumPayload = {
    source: "forum_discord",
    event_type: "message_posted",
    external_user_id: "DISCORD-USER-1024",
    learner_email: "student@example.com",
    metric_key: "discord_message_posted",
    value: 1,
    previous_value: null,
    entity_type: "discord_message",
    entity_id: `message-${Date.now()}`,
    community_id: "DISCORD-SERVER-001",
    channel_id: "channel-help-react",
    happened_at: new Date().toISOString(),
    metadata: {
        platform: "Discord",
        server_name: "Web4Family",
        channel_name: "help-react",
        message_type: "text",
        is_helpful: false,
        is_spam: false,
        validation_status: "tracked",
    },
    dedupe_key: `forum:DISCORD-USER-1024:message_posted:${Date.now()}`,
};

const forumDailyStatsPayload = {
    source: "forum_discord",
    event_type: "daily_forum_activity_summary",
    external_user_id: "DISCORD-USER-1024",
    learner_email: "student@example.com",
    metric_key: "daily_forum_activity",
    value: 1,
    previous_value: null,
    entity_type: "daily_summary",
    entity_id: `DISCORD-USER-1024-${Date.now()}`,
    community_id: "DISCORD-SERVER-001",
    happened_at: new Date().toISOString(),
    metadata: {
        platform: "Discord",
        activity_date: new Date().toISOString().split('T')[0],
        messages_count: 18,
        reactions_count: 34,
        voice_minutes: 75,
        stream_minutes: 20,
        poll_answers_count: 3,
        active_channels: ["general", "help-react", "career-support"],
        validation_status: "tracked",
        spam_detected: false,
    },
    dedupe_key: `forum:DISCORD-USER-1024:daily_summary:${Date.now()}`,
};

const certificationPayload = {
    source: "certification_platform",
    event_type: "challenge_completed",
    external_user_id: "CERT-1024",
    learner_email: "student@example.com",
    metric_key: "certification_challenge_completed",
    value: 1,
    previous_value: null,
    entity_type: "challenge",
    entity_id: "challenge-html-basics-001",
    certification_id: "cert-front-end-001",
    block_id: "block-html-css-001",
    happened_at: new Date().toISOString(),
    metadata: {
        certification_name: "Frontend Web Development",
        block_name: "HTML & CSS Basics",
        challenge_title: "Build a simple landing page",
        difficulty_level: "beginner",
        score: 85,
        passed: true,
        validation_status: "validated",
    },
    dedupe_key: `certification:CERT-1024:challenge_completed:${Date.now()}`,
};

const attendancePayload = {
    source: "attendance_center",
    event_type: "presence_validated",
    external_user_id: "CENTER-1024",
    learner_email: "student@example.com",
    metric_key: "center_presence_day",
    value: 1,
    previous_value: null,
    entity_type: "attendance",
    entity_id: `attendance-${Date.now()}-CENTER-1024`,
    center_id: "CASA-01",
    happened_at: new Date().toISOString(),
    metadata: {
        center_name: "Centre Casablanca",
        presence_date: new Date().toISOString().split('T')[0],
        check_in_time: "09:00",
        check_out_time: "16:30",
        validated_by: "admin-center-01",
        validation_status: "validated",
    },
    dedupe_key: `attendance:CENTER-1024:center_presence_day:${Date.now()}`,
};

// --- Test Plan routing array ---

const tests = [
    { path: '/gamification/web4jobs/events', payload: w4jPayload, name: 'W4J Single' },
    { path: '/gamification/web4jobs/events/batch', payload: [w4jPayload], name: 'W4J Batch' },

    { path: '/gamification/manual-contributions/events', payload: manualContributionPayload, name: 'Manual Contribution Single' },
    { path: '/gamification/manual-contributions/events/batch', payload: [manualContributionPayload], name: 'Manual Contribution Batch' },

    { path: '/gamification/insertion/events', payload: insertionPayload, name: 'Insertion Single' },
    { path: '/gamification/insertion/events/batch', payload: [insertionPayload], name: 'Insertion Batch' },

    { path: '/gamification/forum/events', payload: forumPayload, name: 'Discord Single' },
    { path: '/gamification/forum/events/batch', payload: [forumPayload], name: 'Discord Batch' },
    { path: '/gamification/forum/daily-stats', payload: forumDailyStatsPayload, name: 'Discord Daily Stats' },

    { path: '/gamification/certifications/events', payload: certificationPayload, name: 'Certification Single' },
    { path: '/gamification/certification/events/batch', payload: [certificationPayload], name: 'Certification Batch' },

    { path: '/gamification/attendance/events', payload: attendancePayload, name: 'Attendance Single' },
    { path: '/gamification/attendance/events/batch', payload: [attendancePayload], name: 'Attendance Batch' },
];

// Helper function to send requests
async function runTest(test) {
    const url = `${BASE_URL.replace(/\/$/, '')}/${test.path.replace(/^\//, '')}`;
    
    // Extract the source value to use as the X-API-Key token
    // If it's a batch payload (array), get the source property from the first item
    const singlePayloadObject = Array.isArray(test.payload) ? test.payload[0] : test.payload;
    const apiKey = singlePayloadObject ? singlePayloadObject.source : 'unknown_source';

    console.log(`\n🚀 Sending [${test.name}] to: ${url}`);
    console.log(`🔑 Using Header -> X-API-Key: "${apiKey}"`);
    
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-API-Key': apiKey
            },
            body: JSON.stringify(test.payload)
        });

        const status = response.status;
        console.log(`🔹 Status Code: ${status}`);

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

// Sequence through all configured tests
async function startTesting() {
    console.log('=== Starting Gamification API Test Suite ===');
    for (const test of tests) {
        await runTest(test);
    }
    console.log('\n=== Testing Finished ===');
}

startTesting();