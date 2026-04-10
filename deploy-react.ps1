# PowerShell script to build and deploy React app
# Usage: ./deploy-react.ps1

$ErrorActionPreference = "Stop"

Write-Host "================================================" -ForegroundColor Green
Write-Host "Building React App..." -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Green

# Navigate to React app directory
Set-Location "resources/views/react-app"

# Install dependencies if needed
if (-not (Test-Path "node_modules")) {
    Write-Host "Installing dependencies..." -ForegroundColor Yellow
    npm install
}

# Build the React app
Write-Host "`nRunning npm build..." -ForegroundColor Yellow
npm run build

if ($LASTEXITCODE -ne 0) {
    Write-Host "Build failed!" -ForegroundColor Red
    exit 1
}

Write-Host "Build completed successfully!" -ForegroundColor Green

# Go back to project root
Set-Location "../.."

Write-Host "`n================================================" -ForegroundColor Green
Write-Host "Deploying to public/build..." -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Green

# Remove old build if it exists
if (Test-Path "public/build") {
    Write-Host "Removing old build..." -ForegroundColor Yellow
    Remove-Item -Path "public/build" -Recurse -Force
}

# Copy new build
Write-Host "Copying new build..." -ForegroundColor Yellow
Copy-Item -Path "resources/views/react-app/build" -Destination "public/" -Recurse

Write-Host "`n✓ Deployment completed successfully!" -ForegroundColor Green
Write-Host "`nYour React app is now live at: http://localhost:8000" -ForegroundColor Cyan
Write-Host "Press Ctrl+Shift+Delete in your browser to clear cache if needed." -ForegroundColor Yellow
