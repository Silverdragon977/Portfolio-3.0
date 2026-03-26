



type Props = {
  isSaving: boolean;
};

export function SavingIndicator({ isSaving }: Props) {
  if (!isSaving) return null;

  return (
    <div className="saving-indicator">
      <div className="spinner" />
      <span>Saving...</span>
    </div>
  );
}