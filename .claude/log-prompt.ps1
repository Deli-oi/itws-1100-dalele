param()
$json = [Console]::In.ReadToEnd()
$data = $json | ConvertFrom-Json
$prompt = if ($data.prompt) { $data.prompt.Trim() } else { '' }
$logFile = 'C:\Users\dalele\Desktop\ITWS1100\iit\Labs\Quiz3\prompt-log.md'

$content = ''
if (Test-Path $logFile) {
    $content = Get-Content $logFile -Raw -Encoding utf8
}
$entryNum = ([regex]::Matches($content, '(?m)^## Entry \d+')).Count + 1
$quotedPrompt = $prompt -replace "`n", "`n> "

$entry = @"

---

## Entry $entryNum

**Prompt:**
> $quotedPrompt

**What Claude returned:**

**My reflection:**

- What I kept:
- What I changed:
- What I threw away:
- Why:

"@

[System.IO.File]::AppendAllText($logFile, $entry, [System.Text.Encoding]::UTF8)

$additionalContext = "SYSTEM REMINDER: You MUST edit Labs/Quiz3/prompt-log.md after responding, adding a 1-2 sentence summary of your response in the empty '**What Claude returned:**' section of Entry #$entryNum. Do this as part of your response."

@{
    hookSpecificOutput = @{
        hookEventName = 'UserPromptSubmit'
        additionalContext = $additionalContext
    }
} | ConvertTo-Json -Compress -Depth 5 | Write-Output
